# Mr B WordPress Plugin Skeleton

This is designed to be a starter, skeleton for a typical "functionality Plugin" in a Mr B WordPress project. 

## Getting Started

* `cd` into your `plugins` directory
* Clone and remove git references - `git clone --depth=1 git@github.com:roots/mrb-wordpress-plugin-skeleton.git && rm -rf mrb-wordpress-plugin-skeleton/.git`
* Rename the plugin directory - `mv mrb-wordpress-plugin-skeleton %%my-plugin-name%%`
* Rename the base plugin file - `mv acme.php %%my-plugin-name%%.php`
* Install Composer deps - `composer install`
* Replace references:
  * replace string `HostPluginNamespace` with a namespace for your Plugin - must be a single word, beginning with a captial letter, containing now spaces, hypens or underscores (eg: `ES` )
  * replace string `host_plugin_slug` with the slug for your plugin - should be underscored and all lowercase
  * replace string `hostp_` with a shortened version of your plugin slug for use as a prefix for all template helpers - must include a trailing underscore


## Organisation and Structure

* `mrb-plugin.php` - core Plugin file required by WordPress. Includes autoloader, template functions, registers activation/deactivation and initalises Plugin core.

* `core.php` - primary core file for the Plugin. Initialises core functionality of Plugin including:
  * register Custom Post Types
  * register connections between any Posts
  * initalise Repo classes to interact with `WP_Query`
  * initialise any "Container" classes from `/lib/`
  * register any global actions/filters

* `repos/` - contains all Repository classes. 
  * following the Single Responsibility principle, each Repo is responsible for running `WP_Query` against a particular post type and encapsulating any query-based logic required for that post type.
  * `repos/contracts/repo.php` - base Repo class containing standard methods for interacting with `WP_Query`. Acts as parent class for all individual Repo classes

* `lib/` - contains all the Plugin's custom functionality. All custom functionality should be created as Classes within this directory (see `example.php`)
  * `post-types.php` - use this file to register all your Custom Post Types
  * `post-connections.php` - use this file to register all your Post Connections

* `traits/` - contains all reusable Traits required by the Plugin. 
  * `templateable.php` - provides `locate_template()` method which provides an output buffer way to include PHP template files with the ability to pass data into that template

* `template-functions/` - contains a set of template functions which should be used in Theme template files to interact with the Repos defined in the Plugin. Avoids the need to interact with the Classes directly in the Theme. See `example.php` for example.


### Autoloading

The Plugin provides an autoloader to automatically `include()` Class files. Follow the existing namespacing/filenaming convention and your Classes will be automatically loaded at point of use.

__Please note:__ template-functions are required to be loaded manually. See `template-functions.php`.