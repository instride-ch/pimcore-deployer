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

task('deploy:pimcore:install-classes', function() {
    run('{{bin/php}} {{release_path}}/bin/console deployment:classes-rebuild -c');
});

task('deploy:pimcore:migrate', function() {
    run('{{bin/php}} {{release_path}}/bin/console pimcore:migrations:migrate');
});