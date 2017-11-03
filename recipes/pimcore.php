<?php

namespace Deployer;

task('deploy:pimcore:install-classes', function() {
    run("{{bin/php}} {{release_path}}/bin/console deployment:classes-rebuild -c");
});

task('deploy:pimcore:migrate', function() {
    run('{{bin/console}} pimcore:migrations:migrate');
});