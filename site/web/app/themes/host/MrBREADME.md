# Mr B Wordpress Theme

This is a fork of the excellent [Sage](https://roots.io/sage/) starter Theme. We advise reading the original Sage `README.md` file.

## Installation

1. `cd` into the `/themes` directory of your project
2. Clone and remove git references from Theme - `git clone --depth=1 git@mrbandfriends.git.beanstalkapp.com:/mrbandfriends/mrb-wordpress-theme.git && rm -rf mrb-wordpress-theme/.git`

## Setup

### Assets

Typically we disable the Roots way of including assets. As such you should remove 

* the `/assets` dir 
* the `package.json` file

Include from the Frontend Boilerplate:

* Gulpfile
* `package.json`
* the entire `/assets`/ dir 

## Recommended Plugins

### Premium
* [Advanced Custom Fields](https://en-gb.wordpress.org/plugins/advanced-custom-fields/)
* [Gravity Forms](http://www.gravityforms.com/)
* [WP Migrate DB Pro](https://wordpress.org/plugins/wp-migrate-db/)


### Free
* [Posts 2 Posts](https://en-gb.wordpress.org/plugins/posts-to-posts/) - enables ability to connect Post Types together
* [Attachement Centre Point](https://github.com/jonpearse/attachment-centre-point/) - Jon Pearse FTW!
* [WP Super Cache](https://en-gb.wordpress.org/plugins/wp-super-cache/) - simple file based caching
* [EWWW Image Optimiser](https://en-gb.wordpress.org/plugins/ewww-image-optimizer/) - optimises Images when uploaded
* [User Switching](https://en-gb.wordpress.org/plugins/user-switching/) - allows switching to any User
* [WordPress SEO](https://en-gb.wordpress.org/plugins/wordpress-seo/)
* [WP Optimize](https://en-gb.wordpress.org/plugins/wp-optimize/) - optimise the DB
* [Rewrite Rules Inspector](https://en-gb.wordpress.org/plugins/rewrite-rules-inspector/) - dev plugin to inspect a rewrite rule
* [Stream](https://en-gb.wordpress.org/plugins/stream/) - creates an audit trail
* [Disable Comments](https://en-gb.wordpress.org/plugins/disable-comments/) - disables comments
* [Duplicate Post](https://en-gb.wordpress.org/plugins/duplicate-post/) 
* [Safe Redirect Manager](https://en-gb.wordpress.org/plugins/safe-redirect-manager/) 
* [WP Thumb](https://en-gb.wordpress.org/plugins/wp-thumb/) - image resizing and manipulation
* [Akismet](https://en-gb.wordpress.org/plugins/akismet/) - anti SPAM
* [Members](https://en-gb.wordpress.org/plugins/members) - user role management

## Maintaining against Upstream Sage repo

__Note:__ once you have deployed this Plugin into your project (following steps under "Installation" above) then you should no longer try to maintain the Theme against the original Sage "upstream".

This repo has several changes made to the core Sage files. Nonetheless, it's important we can keep up to date with the latest features in the original Sage project. To do this repo has an upstream set to `git@github.com:roots/sage.git`. 

To pull in the latest changes

1. Create a feature branch 
2. `git fetch upstream` - pulls down latest changes from Sage (doesn't do any merges yet)
3. `git merge upstream/master` - merges upstream changes into your feature
4. Resolve all merge conflicts.
5. Test carefully.
6. Close feature as per standard proceedure.