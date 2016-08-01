# Change Log
All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

For more information about keeping good change logs please refer to [keep a changelog](https://github.com/olivierlacan/keep-a-changelog).

## [1.3.3] - 2015-11-18

### Added
- Responsive Type mixin for typography which scales across viewports in a suitable fashion

## [1.3.2] - 2015-11-18

### Fixed
- Remove fontface async loading file from framework. Now using WebFontLoader and no longer best practice.

## [1.3.1] - 2015-11-18

### Fixed
- Remove reference to SVGForEveryone as was referencing `bower_components`

## [1.3.0] - 2015-11-17

### Added
- Comprehensive README to detail usage and scope.
- added additional objects
- added Gulp notify for Growl-like notifications
- added propert PHP error verbosity management

### Changed
- move PHP config into central bootstrap file 

### Fixed
- Gulp error handling to avoid breaking on error

## [1.2.0] - 2015-08-06

### Added
- "Cut The Mustard" support. Moving towards dropping conditional IE support in favour of true Progressive Enhancement approach

### Changed
- Fixed broken non-flexbox support for top banner items

## [1.1.0] - 2015-08-06

### Added
- Support for RTL languages via `flip()` and auto-reversing direction variables (eg: `#{$padding-left}`)

### Changed
- Add RTL support to grid system
- Add RTL support to offcanvas
- Add RTL support to site banner

## [1.0.0] - 2015-07-21

First major release of the framework.

### Added
- [Sass MQ](https://github.com/sass-mq/sass-mq/pull/10) mixin from the Guardian UK team
- Precommit hooks for linting SCSS and JS before commiting
- Change log file (question: is this inception?)

### Removed
- `respond-to` mixin now deprecated in favour of [Sass MQ](https://github.com/sass-mq/sass-mq/pull/10)
- pre and post breakpoints removed in favour of better use of Sass MQ mixin

### Changed
- Refactor organisation of project to align with [sass-guidelin.es](http://sass-guidelin.es/)

## [1.0.1] - 2015-07-23

### Added
- `on-event` utility mixin for easy `:hover, :focus, :active` authoring
- pages directory and placeholder home page Sass file

### Changed
- Split mixins and functions into separate files

### Fixed
- Ensure that offcanvas toggle is forced to adopt display none when appropriate break point is reached. Previously was too easily to be overidden by site specific styles




