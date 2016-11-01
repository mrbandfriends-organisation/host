
# Change Log
All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

For more information about keeping good change logs please refer to [keep a changelog](https://github.com/olivierlacan/keep-a-changelog).

## Changelog

## [1.10.2] - 2016-11-01

### Fixed
- Safari bug with bleed images not expanding to fill container

## [1.10.1] - 2016-10-31

### Changed
- Reduce quality of homepage images massively to improve load time

## [1.10.0] - 2016-10-31

### Added
- Reinstate cache busting for CSS (requires server config update)
- Add assets caching and expiry rules to Trellis config. Will require deploy to Production
- Add lazyloading for images throughout the site
- Add custom Google Translate implementation. Now doesn't block loading and is generally nice.
- Add IMSanity Plugin to better control sizes of images uploaded to server
- Add Plugin to allow for `nofollow` links

### Changed
- Optimise webfont loading using FontFaceLoader script
- Proritise first render by deferring a tonne of JS
- Chunk more JS to conditionally load based on. Generally only if very expensive to load on all pages (eg: Google Maps)
- Ensure all assets are optimised for Production by default
- Remove preload weirdness being added to all style tags due to customisation by previous Mr B Dev
- 

### Fixed
- Add `alt` attributes to all images across site that are "content" images
- Amend heading levels to ensure `<h1>` on all pages and logical heading order improved
- Force WP Emoji script to be disabled

## [1.9.3] - 2016-10-28

### Added
- Ability for CMS to manage the only static image in the News feed "slice"

### Fixed
- Incorrect ACF field reference on news feed resulting in old image being shown up

## [1.9.2] - 2016-10-19
### Removed
- Don't load SVG from CDN url due to CORS issue

## [1.9.1] - 2016-10-19
### Fixed
- Ensure SVG Sprite is loaded from CDN path correctly via Localised PHP dynamic value
- Reenable Uglify for JS


## [1.9.0] - 2016-10-19
### Added
- Add Util function `cdnify` to manually create CDN links where not auto handeled by WP Rocket
- Add WP Rocket configuration on Plugin to allow for CDN to serve all assets 
- Configure Cloud CDN on Rackspace

## [1.8.5] - 2016-10-17
### Added
- Add `wp-rocket-config` directory with `.gitkeep` file. Required by Plugin on server so adding to repo avoids need to create manually on deploy.

## [1.8.4] - 2016-10-17
### Added
- MU Plugin to allow Editors to amend WP Rocket settings

## [1.8.3] - 2016-10-17
### Added
- Members (Role Manager) Plugin

## [1.8.2] - 2016-10-17
### Added
- User Switching Plugin

### Changed
- Update SEO and Security Plugins

## [1.8.1] - 2016-10-17

### Added
- Rocket NGINX conf for Page Caching

### Fixed
- Ensure that Favourites JS fully removes cookie when there are no favourites. This allows Page Caching to function when you have no unique content related to your session. 

## [1.8.0] - 2016-10-14
### Added
- Adding email field to buildings

## [1.7.8] - 2016-10-07
### Fixed
- Compiled css for Safari & Firefox carousel fix after increasing max-height

## [1.7.7] - 2016-10-07
### Fixed
- Compiled css for Safari & Firefox carousel fix

## [1.7.6] - 2016-10-07
### Fixed
- Safari & FF bug with carousel's high on load. Just Added max-height to any element where JS sets the height

## [1.7.5] - 2016-10-07
### Added
- Testimonials to single building as per PSD

## [1.7.4] - 2016-10-06
### Fixed
- Added NOSCRIPT google tag manager script

## [1.7.3] - 2016-10-05
### Fixed
- Made name of room dynamic in room pricing component

## [1.7.2] - 2016-10-05
### Changed
- Added fallback image for building people section

## [1.7.1] - 2016-10-05
### Fixed
- Compiled assets for release

## [1.7.0] - 2016-10-05
### Fixed
- Fixed issues with bleed image
- Ensured header carousel pause fades out if only one image in carousel

## [1.6.1] - 2016-10-05
### Fixed
- Fixed issues with split featured secondary on Safari

## [1.6.0] - 2016-10-05
### Fixed
- Fixed issues with building page room carousel mobile
- Layout for location POI
- Safari fix for homepage investors image
- Mobile spacing for building favourite button

## [1.5.4] - 2016-10-04
### Fixed
- Fixed issues with tag manager script include

## [1.5.3] - 2016-10-04
### Fixed
- Fixed incorrect tag manager code

## [1.5.2] - 2016-10-04
### Fixed
- Changed Google Tag manager key and removed GA key on production

## [1.5.1] - 2016-10-03
### Fixed
- Js exporting bug

## [1.5.0] - 2016-10-03
### Changed
- Updated hero partial to be more flexible

## [1.4.2] - 2016-10-03
### Changed
- Moved Tag manager output to head

## [1.4.1] - 2016-10-03
### Changed
- Changed Google Tag manager key and removed GA key

## [1.4.0] - 2016-10-03
### Fixed
- Made mistake with creating hotfix 1.3.1 - doing release to fix this and allow chnages to be deployed.

## [1.3.1] - 2016-10-03
### Fixed
- Fixed exporting of gravity forms js to prevent webpack error

## [1.3.0] - 2016-10-03
### Fixed
- Favourite conditional login on location page
- Added gravity form error highlighting
### Added
- Added Postman plugin

## [1.2.0] - 2016-09-30
### Fixed
- Attempt to fix the double location select on mobile

## [1.1.1] - 2016-10-03
This hotfix should be 1.2.1 but due to 1.2.0 not existing remotely at point of creation it has an incorrect name
### Fixed
- Re-added number of rooms field

## [1.0.0] - 2016-09-30

Initial release to master.


## [0.8.0] - 2016-09-30

Beta release to master.




## Template
````
## [0.0.1] - YYYY-MM-DD

### Added
- Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum id sunt blanditiis consectetur explicabo nihil obcaecati provident officia dicta esse illo nobis magnam unde, nostrum, tempora voluptatibus, impedit hic odio?

### Changed
- Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum id sunt blanditiis consectetur explicabo nihil obcaecati provident officia dicta esse illo nobis magnam unde, nostrum, tempora voluptatibus, impedit hic odio?
- Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum id sunt blanditiis consectetur explicabo nihil obcaecati provident officia dicta esse illo nobis magnam unde, nostrum, tempora voluptatibus, impedit hic odio?

### Fixed
- Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum id sunt blanditiis consectetur explicabo nihil obcaecati provident officia dicta esse illo nobis magnam unde, nostrum, tempora voluptatibus, impedit hic odio?
````
