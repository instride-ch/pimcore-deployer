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

task('deploy:yarn:install', function() {
    run('cd {{release_path}} && {{bin/yarn}} install');
});

task('deploy:yarn:encore', function() {
    run('cd {{release_path}} && {{bin/yarn}} run encore production');
});
