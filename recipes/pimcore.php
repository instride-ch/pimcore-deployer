<?php
/**
 * w-vision
 *
 * LICENSE
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that is distributed with this source code.
 *
 * @copyright  Copyright (c) 2017 w-vision AG (https://www.w-vision.ch)
 */

namespace Deployer;


task('deploy:pimcore:install-classes', function () {
    run('{{bin/php}} {{bin/console}} deployment:classes-rebuild -c');
});

task('deploy:pimcore:migrate', function () {
    run('{{bin/php}} {{bin/console}} pimcore:migrations:migrate');
});


task('deploy:pimcore:merge:shared', function () {

    $sharedFiles = get('shared_files');
    $pimcoreSharedConfigFiles = get('pimcore_shared_configurations');

    $all = array_merge($sharedFiles, $pimcoreSharedConfigFiles);
    set('shared_files', $all);

});
before('deploy:shared', 'deploy:pimcore:merge:shared');


// process the pimcore config files
// add empty array if file is empty
task('deploy:pimcore:shared:config', function () {

    $sharedPath = "{{deploy_path}}/shared";
    $emptyContent = "<?php return [];";

    foreach (get('pimcore_shared_configurations') as $configFile) {
        run("[ -s '$sharedPath/$configFile' ] || echo '$emptyContent' >> '$sharedPath/$configFile'");
    }
});
after('deploy:shared', 'deploy:pimcore:shared:config');