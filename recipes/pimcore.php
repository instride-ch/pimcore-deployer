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
    run('{{bin/php}} {{bin/console}} deployment:classes-rebuild -c');
});

task('deploy:pimcore:migrate', function() {
    run('{{bin/php}} {{bin/console}} pimcore:migrations:migrate');
});

desc('Creating symlinks for shared files and dirs');
task('deploy:shared', function () {


    $pimcoreConfigFiles = [
        'var/config/website-settings.php',
        'var/config/reports.php',
        'var/config/extensions.php',
        'var/config/web2print.php',
        'var/config/workflowmanagement.php',
        'var/config/perspectives.php',
        'var/config/customviews.php'
    ];

    $emptyContent = "<?php return [];";


    $sharedPath = "{{deploy_path}}/shared";
    // Validate shared_dir, find duplicates
    foreach (get('shared_dirs') as $a) {
        foreach (get('shared_dirs') as $b) {
            if ($a !== $b && strpos(rtrim($a, '/') . '/', rtrim($b, '/') . '/') === 0) {
                throw new Exception("Can not share same dirs `$a` and `$b`.");
            }
        }
    }
    foreach (get('shared_dirs') as $dir) {
        // Check if shared dir does not exist.
        if (!test("[ -d $sharedPath/$dir ]")) {
            // Create shared dir if it does not exist.
            run("mkdir -p $sharedPath/$dir");
            // If release contains shared dir, copy that dir from release to shared.
            if (test("[ -d $(echo {{release_path}}/$dir) ]")) {
                run("cp -rv {{release_path}}/$dir $sharedPath/" . dirname(parse($dir)));
            }
        }
        // Remove from source.
        run("rm -rf {{release_path}}/$dir");
        // Create path to shared dir in release dir if it does not exist.
        // Symlink will not create the path and will fail otherwise.
        run("mkdir -p `dirname {{release_path}}/$dir`");
        // Symlink shared dir to release dir
        run("{{bin/symlink}} $sharedPath/$dir {{release_path}}/$dir");
    }
    foreach (get('shared_files') as $file) {
        $dirname = dirname(parse($file));
        // Create dir of shared file
        run("mkdir -p $sharedPath/" . $dirname);
        // Check if shared file does not exist in shared.
        // and file exist in release
        if (!test("[ -f $sharedPath/$file ]") && test("[ -f {{release_path}}/$file ]")) {
            // Copy file in shared dir if not present
            run("cp -rv {{release_path}}/$file $sharedPath/$file");
        }
        // Remove from source.
        run("if [ -f $(echo {{release_path}}/$file) ]; then rm -rf {{release_path}}/$file; fi");
        // Ensure dir is available in release
        run("if [ ! -d $(echo {{release_path}}/$dirname) ]; then mkdir -p {{release_path}}/$dirname;fi");
        // Touch shared
        run("touch $sharedPath/$file");

        // check if pimcore config file
        if(in_array($file, $pimcoreConfigFiles)){
            // return of empty array
            run("echo '$emptyContent' >> $sharedPath/$file");

        }

        // Symlink shared dir to release dir
        run("{{bin/symlink}} $sharedPath/$file {{release_path}}/$file");
    }
});