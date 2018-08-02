<?php
/**
 * w-vision
 *
 * LICENSE
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that is distributed with this source code.
 *
 * @copyright  Copyright (c) 2018 w-vision AG (https://www.w-vision.ch)
 */

namespace Deployer;

task('deploy:pimcore:migrate:coreshop', function() {
    run('{{bin/php}} {{bin/console}} pimcore:migrations:migrate -b CoreShopCoreBundle -n');
});
