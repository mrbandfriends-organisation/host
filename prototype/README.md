# Frontend Boilerplate

A comprehensive (and opinionated) set of starter files for the development of Frontend code at Mr B & Friends.

## Introductions...

### What is this for?

The Frontend Boilerplate is designed for use as:

1. A standalone set of frontend assets for use in larger projects powered by a server-side language (eg: CMS websites, Apps...etc)
2. A prototyping framework to facilitate the creation of interactive HTML wireframes
3. A set of files to jump start the development of simple standalone micro-sites and landing pages

### What is this not for?

The Frontend Boilerplate is not...

* A system for creating complex PHP apps or websites (Need this? You should consider [Laravel PHP](http://laravel.com/))
* A fully "designed" CSS framework with a "theme" out of the box (Need this? You should consider [Boostrap](http://getbootstrap.com/))

### What do I get?

It is comprised of:

* A modern, clean and easily extensible CSS framework organised around OOCSS and ITCSS principles 
* A opinionated (and easily extensible) set of simple JavaScript files organised using the CommonJS module system (via WebPack)
* A simple PHP-powered templating system powered by [PlatesPHP](http://platesphp.com/)

## Getting Started


### Install Required Tools

* Install tools (if you haven't already got them!)
  * [Node](https://nodejs.org/en/) & NPM (hint: NPM is installed via the Node installer)
  * [Composer](https://getcomposer.org/)
  * [Ruby](https://www.ruby-lang.org/en/documentation/installation/)
  * [Ruby Gems](https://rubygems.org/pages/download)
  * [Bundler](http://bundler.io/) - `gem install bundler`

* Install packages
  * NPM - `$ npm install`
  * Ruby Gems - `$ bundle install`
  * PHP - `$ composer install`

* PHPtoHTML requires PHPCGI to be in your `$PATH`. Instructions on the [gulp-php2html repo](https://github.com/bezoerb/gulp-php2html#installing-php-cgi).

### Grab a fresh copy of the project

Clone the master branch of the project from the repo (be sure to replace `my-project-name` with the name of your project)
```
git clone --depth 1 --branch master git@mrbandfriends.git.beanstalkapp.com:/mrbandfriends/front-end-boilerplate.git my-project-name
```

Next: 
* `cd` into the `my-project-name` directory
* remove the `.git` directory to ensure you start a fresh Git repository

__PROCEED WITH CAUTION__
```
rm -rf .git/
```

* Initialise a new Git (Flow) repo - `git flow init`

### Configure the Boilerplate

* Point MAMP (or similar) at your project root
* Configure your local environment by adding an `.env.json` file.
  * a `.env.sample.json` file is included in the repo for convenience. 
  * rename this to `.env.json` and amend the values
  * ensure you set the `root_url` value to match the "Server Name" (URL) which you configured in mamp
* Run `gulp` to start watching your files for changes.
* Start coding!

