# Composer template for Sergeant Drupal projects

This is the fork of [Composer template for Drupal projects](https://github.com/drupal-composer/drupal-project). All documentation regarding this project
is available on given url. The notes bellow are addition/override of the source
documentation. The updates from forked project has to be implemented manually.

Lead maintainer: Zan Vidmar ([contact](mailto:zan.vidmar@sergeant.agency))

Maintainer: Aljosa Furlanic ([contact](mailto:aljosa.furlanic@sergeant.agency))

## Usage

### Access
For successful installation of Sergeant modules, read access to Sergeant private repositories is needed.

### Sergeant workflow
[Sergeant drupal project init article (private)](https://sgt.sergeant.agency/wiki/article/drupal-project-init)

### Installation (!)

#### Initialize project with command line generator
1. [command line generator](https://sgt.sergeant.agency/wiki/article/initialize-project-command-line-generator)

#### Initialize project just with composer
First you need to [install composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx).

1. After that you can create the project:

```
composer create-project sergeant/drupal-project:dev-8.x-sgt some-directory --stability dev --no-interaction
```
Change the `some-directory` with your directory where the project will be.

In case if something is not installed correctly try to clear composer cache first (`composer clear-cache`), and than report an issue.

2. Install Drupal with the Installation Profile (everything is handled by sgt_installation_profile module).

3. Create new checklist `/admin/config/sergeant/sgt_checklist` and go trough all checklist items.

### Settings
- For global setting use `/web/sites/*/settings.php`
- For environment settings use `/web/sites/*/settings.local.php`
- For development services use `/web/sites/default/local.services.yml` **(do not use this on production!)**

Development local.services.yml example:
```
parameters:
    session.storage.options: { gc_probability: 1, gc_divisor: 100, gc_maxlifetime: 200000, cookie_lifetime: 2000000 }
    twig.config: { debug: true, auto_reload: true, cache: true }
    renderer.config: { required_cache_contexts: ['languages:language_interface', theme, user.permissions], auto_placeholder_conditions: { max-age: 0, contexts: [session, user], tags: {  } } }
    http.response.debug_cacheability_headers: true
    factory.keyvalue: {  }
    factory.keyvalue.expirable: {  }
    filter_protocols: [http, https, ftp, news, nntp, tel, telnet, mailto, irc, ssh, sftp, webcal, rtsp]
    cors.config: { enabled: false, allowedHeaders: {  }, allowedMethods: {  }, allowedOrigins: ['*'], exposedHeaders: false, maxAge: false, supportsCredentials: false }
```
### Updating Drupal project itself

That will update some settings in composer.json file and also some other Drupal project related files.
Updates are handled by `sergeant/sgt_drupal_project_update`;

To update drupal project to last version:
```composer update_sgt_drupal_project```

or to update it to specific project version:
```composer update_sgt_drupal_project -- v3.0.5```

### Updates (!)
Every time when Drupal core is updated, we have to update Drupal module
Sergeant core (sgt_installation_profile). Sergeant Installation Profile holds all currently active patches
for Drupal core and modules required by Sergeant Installation Profile. All other patches has
to be handled on project level.

## What does this template adds to forked drupal-composer/drupal-project

### Packages required by default (wiht its dependency tree)

All modules listed below in dependency tree are required by default. sergeant/sgt_installation_profille module handles all other required contributed Drupal modules.

Sergeant Drupal project (composer project)
- sgt_core (module)
    - sgt_checklist
        - entity_creator_api
    - sgt_handbook
    - sgt_paragraphs
        - sgt_field_paragraph_settings
- sgt_ignite (theme)
    - sgt_ignite_features
- sgt_installation_profille (profile)
    - all required Drupal modules

### Included repositories
This only include package sources, the installation is optional and always made by developer.

- sergeant/sgt_devel
- sergeant/sgt_filter_query_api
- sergeant/sgt_media_colorbox_field_formatter
- sergeant/sgt_media_crop
- sergeant/sgt_tiles

#### Included Sergeant private repositories:
- sergeant/entity_creator_api ([repo](https://bitbucket.org/sgt_sergeant/entity_creator_api/))
- sergeant/sgt_checklist ([repo](https://bitbucket.org/sgt_sergeant/sgt_checklist/))
- sergeant/sgt_core ([repo](https://bitbucket.org/sgt_sergeant/sgt_core/))
- sergeant/devel ([repo](https://bitbucket.org/sgt_sergeant/sgt_devel/))
- sergeant/sgt_drupal_project_update ([repo](https://bitbucket.org/sgt_sergeant/sgt_drupal_project_update/))
- sergeant/sgt_field_paragraph_settings ([repo](https://bitbucket.org/sgt_sergeant/sgt_field_paragraph_settings/))
- sergeant/sgt_filter_query_api ([repo](https://bitbucket.org/sgt_sergeant/sgt_filter_query_api/))
- sergeant/sgt_handbook ([repo](https://bitbucket.org/sgt_sergeant/sgt_handbook/))
- sergeant/sgt_ignite ([repo](https://bitbucket.org/sgt_sergeant/sgt_ignite/))
- sergeant/sgt_ignite_features ([repo](https://bitbucket.org/sgt_sergeant/sgt_ignite_features/))
- sergeant/sgt_installation_profile ([repo](https://bitbucket.org/sgt_sergeant/sgt_installation_profile/))
- sergeant/sgt_media_colorbox_field_formatter ([repo](https://bitbucket.org/sgt_sergeant/sgt_media_colorbox_field_formatter/))
- sergeant/sgt_media_crop ([repo](https://bitbucket.org/sgt_sergeant/sgt_media_crop/))
- sergeant/sgt_paragraphs ([repo](https://bitbucket.org/sgt_sergeant/sgt_paragraphs/))
- sergeant/sgt_tiles ([repo](https://bitbucket.org/sgt_sergeant/sgt_tiles/))

#### Required contrib packages (JS libraries)
- harvesthq/chosen is required via sgt_installation_profille => drupal/chosen. Drupal project composer.json file includes requrements mentioned in drupal/chosen readme file. ([repo](https://github.com/harvesthq/chosen), [docs](https://harvesthq.github.io/chosen/))

#### Included contrib packages (JS libraries)
- gfranko/jquery.tocify.js `composer require gfranko/jquery.tocify.js` ([repo](https://github.com/gfranko/jquery.tocify.js), [docs](http://gregfranko.com/jquery.tocify.js/))
- jackmoore/colorbox `composer require jackmoore/colorbox` ([repo](https://github.com/jackmoore/colorbox), [docs](http://www.jacklmoore.com/colorbox/guide/))
- rsportella/popper_js `composer require rsportella/popper_js` ([repo](https://github.com/FezVrasta/popper.js), [docs](https://popper.js.org/))
- rsportella/popper_tooltip_js `composer require rsportella/popper_tooltip_js` ([repo](https://github.com/FezVrasta/popper.js), [docs](https://popper.js.org/tooltip-examples.html))

### Composer file modifications

#### Installer paths

Installer paths are changed to a non standard paths, to met the Sergeant
workflow with Sergeant modules and Sergeant Ignite theme.

All Sergeant modules are placed in `web/modules/sgt/` directory.
```
"web/modules/sgt/{$name}": [
    "sergeant/sgt_checklist",
    "sergeant/sgt_core",
    "sergeant/sgt_devel",
    "sergeant/sgt_field_paragraph_settings",
    "sergeant/sgt_filter_query_api",
    "sergeant/sgt_handbook",
    "sergeant/sgt_ignite_features",
    "sergeant/sgt_media_colorbox_field_formatter",
    "sergeant/sgt_media_crop",
    "sergeant/sgt_paragraphs",
    "sergeant/sgt_tiles"
],
```
The structure of module folder:
- contrib `web/modules/contrib/` (for Drupal contrib modules, git ignored, managed by composer)
- custom `web/modules/custom/` (for Drupal custom modules per project, git managed)
- sgt `web/modules/sgt/` (for Sergeant Drupal contrib modules, git ignored, managed by composer)

Sergeant Ignite theme is placed in `web/themes/sgt_ignite/` directory.
```
"web/themes/sgt_ignite/ignite_core": [
    "sergeant/sgt_ignite"
],
```

Sergeant installation profile is placed in in `web/profiles/sgt/` directory.
```
"web/profiles/sgt/{$name}": [
    "sergeant/sgt_installation_profile"
]
```

### Other modifications

- Custom folders ("_local_backups", "private", "tmp") are added into $dir array in `scripts/composer/ScriptHandler.php` file.
- to accept patches from dependencies `"enable-patching": true` was added to `extra` section (source: [composer-patches](https://github.com/cweagans/composer-patches#allowing-patches-to-be-applied-from-dependencies))
- Create the files directory with chmod 0775 instead of 0777
- ScriptHandler (with related json autoload => classmap) has additional function that copy all configuration files from Drupal standard profile to Sergeant Installation Profile.

### PHP version
This template by default requires at least PHP 7

# DDEV setup
- [ddev repo](https://github.com/drud/ddev)
- [ddev command line generator](https://sgt.sergeant.agency/wiki/article/initialize-project-command-line-generator)

## Troubleshooting
In case of denied acces to private repos add keys to ddev container by `ddev auth ssh` command
