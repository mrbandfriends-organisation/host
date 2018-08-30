=== Disable Gutenberg ===

Plugin Name: Disable Gutenberg
Plugin URI: https://perishablepress.com/disable-gutenberg/
Description: Disable Gutenberg Editor and replace with Classic Editor.
Tags: gutenberg, disable, post types, g7g
Author: Jeff Starr
Author URI: https://plugin-planet.com/
Donate link: https://monzillamedia.com/donate.html
Contributors: specialk
Requires at least: 4.5
Tested up to: 4.9.8
Stable tag: 1.2
Version: 1.2
Requires PHP: 5.2
Text Domain: disable-gutenberg
Domain Path: /languages
License: GPL v2 or later

Disable Gutenberg Editor and replace with Classic Editor. Selectively disable for posts, pages, roles, post types, and theme templates. Hide the Gutenberg nag, menu item, and more!



== Description ==

This plugin disables the new Gutenberg Editor and replaces it with the Classic Editor. You can disable Gutenberg completely, or selectively disable for posts, pages, roles, post types, and theme templates. Plus you can hide the Gutenberg nag, menu item, and more!

> The all-in-one, COMPLETE solution handling Gutenberg.

> Hide ALL traces of Gutenberg and replace with the Classic Editor.

The Disable Gutenberg plugin restores the classic (original) WordPress editor and the "Edit Post" screen. So you can continue using plugins and theme functions that extend the Classic Editor. Supports awesome features like Meta Boxes, Quicktags, Custom Fields, and everything else the Classic Editor can do.

**Options**

* Disable Gutenberg completely (all post types)
* Disable Gutenberg for any post type
* Disable Gutenberg for any user role
* NEW: Disable Gutenberg for any theme template
* NEW: Disable Gutenberg for any post/page IDs
* Disable Gutenberg admin notice (nag)
* Option to hide the plugin menu item
* NEW: Option to hide the Gutenberg plugin menu item (settings link)

Fully configurable, enable or disable Gutenberg and restore the Classic Editor wherever is necessary.

_Automatically replaces Gutenberg with the Classic Editor._

**Features**

* Super simple
* Clean, secure code
* Built with the WordPress API
* Lightweight, fast and flexible
* Regularly updated and "future proof"
* Works great with other WordPress plugins
* Plugin options configurable via settings screen
* Focused on flexibility, performance, and security
* One-click restore plugin default options
* Translation ready

Plus, unlike similar plugins, Disable Gutenberg does NOT add extra Gutenberg options to the WordPress "Writing" settings.

_Super light & fast plugin, super easy on server resources!_

**Why?**

Gutenberg is a useful editor but sometimes you want to disable it for specific posts, pages, user roles, post types, or theme templates. Disable Gutenberg enables you to disable Gutenberg and replace it with the Classic Editor wherever you want. For example, lots of WordPress users already enjoy robust page-building functionality via one of the many great plugins like Composer or Elementor. So many options, no need to feel "locked in" to using Gutenberg!

The Disable Gutenberg plugin is targeted at everyone who is not ready for the major changes brought by Gutenberg. Install Disable Gutenberg NOW to be ready for when Gutenberg is finally merged into core and released to the public (likely in WP 5.0). That way, your users and clients will experience the same awesome UX as before ;)

**GDPR**

This plugin does not collect any user data. So it does _not_ do anything to make your site _less_ compliant with GDPR. I have done my best to ensure that this plugin is 100% GDPR compliant, but I'm not a lawyer so can't guarantee anything. To determine if your site is GDPR compliant, please consult an attorney.

__If you like this plugin, please give it a 5-star rating to encourage future development.__



== Screenshots ==

1. Plugin Settings screen (showing default options)
2. Plugin Settings screen (showing expanded options)



== Installation ==

**Installing the plugin**

1. Upload the plugin to your blog and activate
2. Configure the plugin settings as desired
3. Enable theme switcher via settings or shortcode

[More info on installing WP plugins](http://codex.wordpress.org/Managing_Plugins#Installing_Plugins)


**Hide Menu Option**

Disable Gutenberg provides a setting to disable the plugin's menu item. This is useful if you don't want your clients to get curious and start fiddling around.

If you enable the option to hide the plugin's menu item, you will need to access the plugin settings page directly. It is located at:

`/wp-admin/options-general.php?page=disable-gutenberg`

So if WordPress is installed at this URL:

`https://example.com/`

..then you would access the plugin settings at:

`https://example.com/wp-admin/options-general.php?page=disable-gutenberg`

Or, if WordPress is installed in a subdirectory, for example:

`https://example.com/wordpress/`

..then you would access the plugin settings at:

`https://example.com/wordpress/wp-admin/options-general.php?page=disable-gutenberg`

So if you hide the plugin's menu item, you always can access the settings directly.


**Uninstalling**

This plugin cleans up after itself. All plugin settings will be removed from your database when the plugin is uninstalled via the Plugins screen.



== Upgrade Notice ==

To upgrade this plugin, remove the old version and replace with the new version. Or just click "Update" from the Plugins screen and let WordPress do it for you automatically.

Note: uninstalling the plugin from the WP Plugins screen results in the removal of all settings and data from the WP database. 



== Frequently Asked Questions ==

**Will this work without Gutenberg?**

Yes. When Gutenberg is active, the plugin disables it (depending on your selected options) and replaces with the Classic Editor. Otherwise, if Gutenberg is not active, the plugin does nothing. So it's totally fine to install before Gutenberg is added to WP core, so it will be ready when the time comes.


**Got a question?**

Send any questions or feedback via my [contact form](https://perishablepress.com/contact/)



== Support development of this plugin ==

I develop and maintain this free plugin with love for the WordPress community. To show support, you can [make a donation](https://monzillamedia.com/donate.html) or purchase one of my books:

* [The Tao of WordPress](https://wp-tao.com/)
* [Digging into WordPress](https://digwp.com/)
* [.htaccess made easy](https://htaccessbook.com/)
* [WordPress Themes In Depth](https://wp-tao.com/wordpress-themes-book/)

And/or purchase one of my premium WordPress plugins:

* [BBQ Pro](https://plugin-planet.com/bbq-pro/) - Super fast WordPress firewall
* [Blackhole Pro](https://plugin-planet.com/blackhole-pro/) - Automatically block bad bots
* [Banhammer Pro](https://plugin-planet.com/banhammer-pro/) - Monitor traffic and ban the bad guys
* [USP Pro](https://plugin-planet.com/usp-pro/) - Unlimited front-end forms

Links, tweets and likes also appreciated. Thanks! :)



== Changelog ==

**1.2 (2018/08/14)**

* Adds `rel="noopener noreferrer"` to all [blank-target links](https://perishablepress.com/wordpress-blank-target-vulnerability/)
* Adds options to disable Gutenberg for specific post templates and post IDs
* Adds option to hide/remove the Gutenberg plugin menu item
* Adds Classic Editor replacement for WP 5.0 (in progress)
* Fixes object-related PHP warning in enqueue script
* Updates GDPR blurb and donate link
* Tweaks CSS on plugin settings page
* Adds "rate this" link to settings page
* Generates default translation template
* Further tests on WP versions 4.9 and 5.0 (alpha)

**1.1 (2018/05/06)**

* Removes unused .otf font file
* Adds option to disable "Try Gutenberg" nag (admin notice)
* Adds option to hide the plugin's menu item
* Further testing on WP 5.0 (alpha)


**1.0 (2018/04/16)**

* Initial release
