<?php

namespace Deployer;

set('bin/npm', function () {
    return locateBinaryPath('npm');
});

task('npm:install', function () {
    if (has('previous_release')) {
        if (test('[ -d {{previous_release}}/node_modules ]')) {
            run('cp -R {{previous_release}}/node_modules {{release_path}}');
        }
    }
    run("cd {{release_path}} && {{bin/npm}} install");
});
task('npm:production', function() {
    run('cd {{release_path}} && {{bin/npm}} run build');
});
task('npm:develop', function() {
    run('cd {{release_path}} && {{bin/npm}} run dev');
});