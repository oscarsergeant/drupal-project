# Composer template for Sergeant Drupal projects

This is the fork of [Composer template for Drupal projects](https://github.com/drupal-composer/drupal-project). All documentation regarding this project
is available on given url. The notes bellow are addition/override of the source
documentation. The updates from forked project has to be implemented manually.

Lead maintainer: Zan Vidmar ([contact](mailto:zan.vidmar@sergeant.agency))

Maintainer: Aljosa Furlanic ([contact](mailto:aljosa.furlanic@sergeant.agency))

## Usage

### Access
For successful installation of Sergeant modules, read access to Sergeant private repositories is needed.

### Installation (!)
First you need to [install composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx).

1. After that you can create the project:

```
composer create-project sergeant/drupal-project:dev-8.x-sgt some-directory --stability dev --no-interaction
```
Change the `some-directory` with your directory where the project will be. 

In case if something is not installed correctly try to clear composer cache first (`composer clear-cache`), and than report an issue.

2. Install sgt_core module to initiate all default modules and theme.

```
drush en sgt_core
```
3. Create new checlkist `/admin/config/sergeant/sgt_checklist` and go trough all checklist items.

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

### Updates (!)
Every time when Drupal core is updated, we have to update Drupal module 
Sergeant core (sgt_core). Sergeant core holds all currently active patches
for Drupal core and modules required by Sergeant core. All other patches has
to be handled on project level.

## What does this template adds to forked drupal-composer/drupal-project

### Packages required by default
- sergeant/sgt_core (this module handle all other default modules) ([repo](https://bitbucket.org/sgt_sergeant/sgt_core/))

The snippet below is already included into composer.json:
```
"repositories": [
  {
    "type": "vcs",
    "url": "git@bitbucket.org:sgt_sergeant/sgt_core.git"
  },
]
```

### Included repositories
This only include package sources, the installation is always made by user 
request (except for the default ones => sgt_core and sgt_ignite. And the ones that are required in sgt_core => sgt_checklist, sgt_paragraphs and sgt_field_paragraph_settings).

#### Included Sergeant private repositories:
- sgt_sergeant/sgt_checklist ([repo](https://bitbucket.org/sgt_sergeant/sgt_checklist/))
- sgt_sergeant/sgt_core ([repo](https://bitbucket.org/sgt_sergeant/sgt_core/))
- sgt_sergeant/sgt_field_paragraph_settings ([repo](https://bitbucket.org/sgt_sergeant/sgt_field_paragraph_settings/))
- sgt_sergeant/sgt_handbook ([repo](https://bitbucket.org/sgt_sergeant/sgt_handbook/))
- sgt_sergeant/sgt_ignite ([repo](https://bitbucket.org/sgt_sergeant/sgt_ignite/))
- sgt_sergeant/sgt_media_colorbox_field_formatter ([repo](https://bitbucket.org/sgt_sergeant/sgt_media_colorbox_field_formatter/))
- sgt_sergeant/sgt_media_crop ([repo](https://bitbucket.org/sgt_sergeant/sgt_media_crop/))
- sgt_sergeant/sgt_paragraphs ([repo](https://bitbucket.org/sgt_sergeant/sgt_paragraphs/))

#### Included contrib packages (JS libraries)
- harvesthq/chosen `composer require harvesthq/chosen` ([repo](https://github.com/harvesthq/chosen), [docs](https://harvesthq.github.io/chosen/)) 
- gfranko/jquery.tocify.js `composer require gfranko/jquery.tocify.js` ([repo](https://github.com/gfranko/jquery.tocify.js), [docs](http://gregfranko.com/jquery.tocify.js/))
- jackmoore/colorbox `composer require jackmoore/colorbox` ([repo](https://github.com/jackmoore/colorbox), [docs](http://www.jacklmoore.com/colorbox/guide/))
- rsportella/popper `composer require rsportella/popper` ([repo](https://github.com/FezVrasta/popper.js), [docs](https://popper.js.org/))
- rsportella/popper_tooltip `composer require rsportella/popper_tooltip` ([repo](https://github.com/FezVrasta/popper.js), [docs](https://popper.js.org/tooltip-examples.html))
### Composer file modifications

#### Installer paths

Installer paths are changed to a non standard paths, to met the Sergeant 
workflow with Sergeant modules and Sergeant Ignite theme.

All Sergeant modules are placed in `web/modules/sgt/` directory.
```
"web/modules/sgt/{$name}": ["type:drupal-custom-module"],
```
The structure of module folder:
- contrib `web/modules/contrib/` (for Drupal contrib modules, git ignored, managed by composer)
- custom `web/modules/custom/` (for Drupal custom modules per project, git managed)
- sgt `web/modules/sgt/` (for Sergeant Drupal contrib modules, git ignored, managed by composer)

A path defined especially for Sergeant Ignite theme
```
"web/themes/sgt_ignite/ignite_core": ["type:drupal-custom-theme"]
```

### Other modifications

- "tmp" folder is added into $dir array in `scripts/composer/ScriptHandler.php` file.
- to accept patches from dependencies `"enable-patching": true` was added to `extra` section (source: [composer-patches](https://github.com/cweagans/composer-patches#allowing-patches-to-be-applied-from-dependencies))
- Create the files directory with chmod 0775 insted of 0777

### PHP version
This template by default requires at least PHP 7
