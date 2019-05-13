# Composer template for Sergeant Drupal projects

This is the fork of [Composer template for Drupal projects](https://github.com/drupal-composer/drupal-project). All documentation regarding this project
is available on given url. The notes bellow are addition/override of the source
documentation. The updates from forked project has to be implemented manually.

Lead maintainer: Zan Vidmar ([contact](mailto:zan.vidmar@sergeant.agency))

## Usage

### Access
For successful installation of Sergeant modules, read access to Sergeant private repositories is needed.

### Installation (!)
First you need to [install composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx).

After that you can create the project:

```
composer create-project sergeant/drupal-project:~8.0 some-directory --stability dev --no-interaction
```
Change the `some-directory` with your directory where the project will be. 

### Settings 
For environment based setting use `/web/sites/*/settings.php`
For all environment settings use `/web/sites/*/settings.local.php`

### Updates (!)
Every time when Drupal core is updated, we have to update Drupal module 
Sergeant core (sgt_core). Sergeant core holds all currently active patches
for Drupal core and modules required by Sergeant core. All other patches has
to be handled on project level.

## What does this template adds to forked drupal-composer/drupal-project

### Packages required by default
- sergeant/sgt_core (this module handle all other default modules)

### Included repositories
This only include package sources, the installation is always made by user 
request (except for the default one => sgt_core).

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
- harvesthq/chosen ([repo](https://github.com/harvesthq/chosen), [docs](https://harvesthq.github.io/chosen/))
- gfranko/jquery.tocify.js ([repo](https://github.com/gfranko/jquery.tocify.js), [docs](http://gregfranko.com/jquery.tocify.js/))
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

### PHP version
This template by default requires at least PHP 7
