<?php

namespace Deployer;

set('bin/yarn', function () {
    return locateBinaryPath('yarn');
});

task('deploy:yarn:install', function() {
    run("cd {{release_path}} && {{bin/yarn}} install");
});

task('deploy:yarn:encore', function() {
    run("cd {{release_path}} && {{bin/yarn}} run encore production");
});
