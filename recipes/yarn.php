<?php

namespace Deployer;

set('bin/yarn', function () {
    if (commandExist('yarn')) {
        return run('which yarn')->toString();
    }
    return false;
});

task('deploy:yarn:install', function() {
    run("cd {{release_path}} && {{env_vars}} {{bin/yarn}} install");
});

task('deploy:yarn:encore', function() {
    run("cd {{release_path}} && {{env_vars}} {{bin/yarn}} run encore production");
});
