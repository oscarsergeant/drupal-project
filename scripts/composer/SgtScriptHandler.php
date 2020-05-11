<?php

/**
 * @file
 * Contains \SgtInstallationProfile\composer\ScriptHandler.
 */
namespace SgtInstallationProfile;

use DrupalFinder\DrupalFinder;

class SgtScriptHandler {

  /**
   * This works like update hook that sets all needed json settings to latest
   * requirements.
   */
  public static function preUpdate() {

    $authors = [
      [
        'name' => 'Sergeant Agency',
        'email' => 'drupal@sergeant.agency',
        'homepage' => 'https://www.sergeant.agency/',
        'role' => 'Developer'
      ]
    ];

    $repositories = [
      [
        'type' => 'composer',
        'url' => 'https://packages.drupal.org/8',
      ],
      [
        'type' => 'vcs',
        'url' => 'git@bitbucket.org:sgt_sergeant/entity_creator_api.git',
      ],
      [
        'type' => 'vcs',
        'url' => 'git@bitbucket.org:sgt_sergeant/sgt_installation_profile.git',
      ],
      [
        'type' => 'vcs',
        'url' => 'git@bitbucket.org:sgt_sergeant/sgt_checklist.git',
      ],
      [
        'type' => 'vcs',
        'url' => 'git@bitbucket.org:sgt_sergeant/sgt_core.git',
      ],
      [
        'type' => 'vcs',
        'url' => 'git@bitbucket.org:sgt_sergeant/sgt_devel.git',
      ],
      [
        'type' => 'vcs',
        'url' => 'git@bitbucket.org:sgt_sergeant/sgt_field_paragraph_settings.git',
      ],
      [
        'type' => 'vcs',
        'url' => 'git@bitbucket.org:sgt_sergeant/sgt_filter_query_api.git',
      ],
      [
        'type' => 'vcs',
        'url' => 'git@bitbucket.org:sgt_sergeant/sgt_handbook.git',
      ],
      [
        'type' => 'vcs',
        'url' => 'git@bitbucket.org:sgt_sergeant/sgt_ignite.git',
      ],
      [
        'type' => 'vcs',
        'url' => 'git@bitbucket.org:sgt_sergeant/sgt_ignite_features.git',
      ],
      [
        'type' => 'vcs',
        'url' => 'git@bitbucket.org:sgt_sergeant/sgt_media_colorbox_field_formatter.git',
      ],
      [
        'type' => 'vcs',
        'url' => 'git@bitbucket.org:sgt_sergeant/sgt_media_crop.git',
      ],
      [
        'type' => 'vcs',
        'url' => 'git@bitbucket.org:sgt_sergeant/sgt_paragraphs.git',
      ],
      [
        'type' => 'vcs',
        'url' => 'git@bitbucket.org:sgt_sergeant/sgt_tiles.git',
      ],
      [
        'type' => 'package',
        'package' => [
          'name' => 'gfranko/jquery.tocify.js',
          'version' => '1.9.0',
          'type' => 'drupal-library',
          'extra' => [
            'installer-name' => 'jquery.tocify/js',
          ],
          'dist' => [
            'url' => 'https://raw.githubusercontent.com/gfranko/jquery.tocify.js/master/src/javascripts/jquery.tocify.js',
            'type' => 'file',
          ],
        ],
      ],
      [
        'type' => 'package',
        'package' => [
          'name' => 'jackmoore/colorbox',
          'version' => '1.6.4',
          'type' => 'drupal-library',
          'dist' => [
            'url' => 'https://github.com/jackmoore/colorbox/archive/1.6.4.zip',
            'type' => 'zip',
          ],
        ],
      ],
      [
        'type' => 'package',
        'package' => [
          'name' => 'rsportella/popper_js',
          'version' => 'dev-master',
          'type' => 'drupal-library',
          'extra' => [
            'installer-name' => 'popper/js',
          ],
          'dist' => [
            'url' => 'https://unpkg.com/popper.js@1.16.0/dist/umd/popper.min.js',
            'type' => 'file',
          ],
          'require' => [
            'rsportella/popper_tooltip_js' => 'dev-master',
          ],
        ],
      ],
      [
        'type' => 'package',
        'package' => [
          'name' => 'rsportella/popper_tooltip_js',
          'version' => 'dev-master',
          'type' => 'drupal-library',
          'extra' => [
            'installer-name' => 'popper_tooltip/js',
          ],
          'dist' => [
            'url' => 'https://unpkg.com/tooltip.js@1.3.2/dist/umd/tooltip.min.js',
            'type' => 'file',
          ],
        ],
      ]
    ];

    $require = [
      'php' => '>=7.0.8',
      'composer/installers' => '^1.2',
      'cweagans/composer-patches' => '^1.6.5',
      'drupal/console' => '^1.0.2',
      'drupal/core' => '^8.8.0',
      'drupal/core-composer-scaffold' => '^8.8.0',
      'drush/drush' => '^9.7.1 | ^10.0.0',
      'oomphinc/composer-installers-extender' => '^1.1',
      'sergeant/sgt_core' => '^8.0',
      'sergeant/sgt_ignite' => '^8.0',
      'sergeant/sgt_installation_profile' => '^8.0',
      'vlucas/phpdotenv' => '^4.0',
      'webflo/drupal-finder' => '^1.0.0',
      'zaporylie/composer-drupal-optimizations' => '^1.0'
    ];

    $remove_require = [
      'drupal-composer/drupal-scaffold',
      'webmozart/path-util',
    ];

    $require_dev = [
      'drupal/core-dev' => '^8.8.0'
    ];

    $remove_require_dev = [
      'webflo/drupal-core-require-dev'
    ];

    $autoload = [
      'classmap' => [
        'scripts/composer/ScriptHandler.php',
        'scripts/composer/SgtScriptHandler.php,',
        'web/profiles/sgt/sgt_installation_profile/SgtInstallationProfile/SgtInstallationProfileScriptHandler.php'
      ],
      'files' => ['load.environment.php']
    ];

    $scripts = [
      'pre-install-cmd' => [
        'DrupalProject\\composer\\ScriptHandler::checkComposerVersion'
      ],
      'pre-update-cmd' => [
        'DrupalProject\\composer\\ScriptHandler::checkComposerVersion',
        "DrupalProject\\composer\\SgtScriptHandler::preUpdate"
      ],
      'post-install-cmd' => [
        'DrupalProject\\composer\\ScriptHandler::createRequiredFiles'
      ],
      'post-update-cmd' => [
        'DrupalProject\\composer\\ScriptHandler::createRequiredFiles'
      ],
    ];

    $installer_paths = [
      'web/core' => ['type:drupal-core'],
      'web/libraries/{$name}' => [
        'type:drupal-library',
        'harvesthq/chosen' // For chosen only
      ],
      'web/modules/contrib/{$name}' => ['type:drupal-module'],
      'web/profiles/contrib/{$name}' => ['type:drupal-profile'],
      'web/themes/contrib/{$name}' => ['type:drupal-theme'],
      'drush/Commands/contrib/{$name}' => ['type:drupal-drush'],
      'web/modules/sgt/{$name}' => [
        'sergeant/entity_creator_api',
        'sergeant/sgt_checklist',
        'sergeant/sgt_core',
        'sergeant/sgt_devel',
        'sergeant/sgt_field_paragraph_settings',
        'sergeant/sgt_filter_query_api',
        'sergeant/sgt_handbook',
        'sergeant/sgt_ignite_features',
        'sergeant/sgt_media_colorbox_field_formatter',
        'sergeant/sgt_media_crop',
        'sergeant/sgt_paragraphs',
        'sergeant/sgt_tiles'
      ],
      'web/themes/sgt_ignite/ignite_core' => ['sergeant/sgt_ignite'],
      'web/profiles/sgt/{$name}' => ['sergeant/sgt_installation_profile']
    ];

    $remove_drupal_scaffold = [
      'initial'
    ];

    $drupal_scaffold = [
      'locations' => [
        'web-root' =>  'web/'
      ]
    ];

    $drupalFinder = new DrupalFinder();
    $drupalFinder->locateRoot(getcwd());
    $drupalRoot = $drupalFinder->getDrupalRoot();

    $composer_json = file_get_contents($drupalRoot . '/../composer.json');
    $data = json_decode($composer_json, true);

    // Set authors in json as they should be.
    $data['authors'] = $authors;

    // Set all custom json repositories as they should be.
    $data['repositories'] = $repositories;

    // Remove all deprecated requirements.
    foreach ($remove_require as $package_name) {
      if (isset($data['require'][$package_name])) {
        unset($data['require'][$package_name]);
      }
    }

    // Set all requirements as they should be.
    foreach ($require as $package_name => $version) {
      $data['require'][$package_name] = $version;
    }

    // Remove all deprecated development requirements.
    foreach ($remove_require_dev as $package_name) {
      if (isset($data['require-dev'][$package_name])) {
        unset($data['require-dev'][$package_name]);
      }
    }

    // Set all development requirements as they should be.
    foreach ($require_dev as $package_name => $version) {
      $data['require-dev'][$package_name] = $version;
    }

    // Set all autoload data as it should be.
    $data['autoload'] = $autoload;

    $data['scripts'] = $scripts;

    // This are settings required for chosen library
    $data['extra']['installer-types'] = ['library'];

    // Set all installer paths as they should be.
    $data['extra']['installer-paths'] = $installer_paths;

    // Remove all deprecated Drupal scaffold settings.
    foreach ($remove_drupal_scaffold as $setting) {
      if (isset($data['extra']['drupal-scaffold'][$setting])) {
        unset($data['extra']['drupal-scaffold'][$setting]);
      }
    }

    // Set all Drupal scaffold settings.
    foreach ($drupal_scaffold as $setting => $setting_value) {
      $data['extra']['drupal-scaffold'][$setting] = $setting_value;
    }


    // @todo:
    //    1. Override existing load.environment.php file in project with one that is in Sergeant Drupal project
    //
    //curl -O https://raw.githubusercontent.com/oscarsergeant/drupal-project/8.x-sgt/load.environment.php
    //2. Override existing scripts/composer/ScriptHandler.php file in project with one that is in Sergeant Drupal project
    //
    //curl -o scripts/composer/ScriptHandler.php https://raw.githubusercontent.com/oscarsergeant/drupal-project/8.x-sgt/scripts/composer/ScriptHandler.php
    //3. Override existing .travis.yml file in project with one that is in Sergeant Drupal project
    //
    //curl -O https://raw.githubusercontent.com/oscarsergeant/drupal-project/8.x-sgt/.travis.yml
    //4. Update php version in json file without triggering update process.

    /*
      <?php
      set_time_limit(0);
      //This is the file where we save the    information
      $fp = fopen (dirname(__FILE__) . '/localfile.tmp', 'w+');
      //Here is the file we are downloading, replace spaces with %20
      $ch = curl_init(str_replace(" ","%20",$url));
      curl_setopt($ch, CURLOPT_TIMEOUT, 50);
      // write curl response to file
      curl_setopt($ch, CURLOPT_FILE, $fp);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      // get curl response
      curl_exec($ch);
      curl_close($ch);
      fclose($fp);
      ?>
     */


    $new_composer_json = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents($drupalRoot . '/../composer.json', $new_composer_json);
  }

}
