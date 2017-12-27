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

set('bin/yarn', function () {
    return locateBinaryPath('yarn');
});

task('deploy:yarn:install', function () {
    if (has('previous_release')) {
        if (test('[ -d {{previous_release}}/node_modules ]')) {
            run('cp -R {{previous_release}}/node_modules {{release_path}}');
        }
    }

    run('cd {{release_path}} && {{bin/yarn}} install');
});

task('deploy:yarn:develop', function() {
    run('cd {{release_path}} && {{bin/yarn}} run dev');
});

task('deploy:yarn:production', function() {
    run('cd {{release_path}} && {{bin/yarn}} run build');
});
