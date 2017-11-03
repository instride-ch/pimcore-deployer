<?php

namespace Deployer;

require __DIR__ . '/vendor/deployer/deployer/recipe/symfony3.php';  //Comes form deployer.phar
require __DIR__ . '/vendor/w-vision/pimcore-deployer/recipe/pimcore.php';
require __DIR__ . '/vendor/w-vision/pimcore-deployer/recipe/yarn.php';

set('repository', 'ssh://git@server:22/vendor/project.git');
// Can be done via http as well.

//There maybe some files or directories missing.

set('default_stage', 'dev');
set('shared_files', [
    'app/config/parameters.yml',
    'var/config/system.php',
    'var/config/extensions.php',
    'var/config/debug-mode.php',
    'var/config/maintenance.php',
    'var/config/web2print.php',
    'var/config/GeoLite2-City.mmdb'
]);
set('shared_dirs', [
    'web/var',
    'var/email',
    'var/recyclebin',
    'var/versions',
    'var/sessions'
]);

inventory(__DIR__ . '/deployer/servers.yml');

// If your PHP executable is installed within a non standard path, use this:
/*set('bin/php', function () {
    return '/opt/cpanel/ea-php70/root/usr/bin/php';
});*/

// If you want to use a custom composer file, use this
/*
set('bin/composer', function() {
    return '{{bin/php}} composer.phar';
});*/

desc('Deploy your project');
task('deploy', [
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:assets:install',
    'deploy:yarn:install',          //Remove if you don't use yarn
    'deploy:yarn:encore',           //Remove if you don't use yarn
    'deploy:pimcore:migrate',
    'deploy:clear_paths',
    'deploy:pimcore:install-classes',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
])->desc('Deploy your project');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');