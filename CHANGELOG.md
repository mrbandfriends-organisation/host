
# Change Log
All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

For more information about keeping good change logs please refer to [keep a changelog](https://github.com/olivierlacan/keep-a-changelog).

## Changelog

## [1.26.10] - 2018-07-23
### Added
- Adding Recaptcha JS call to head

## [1.26.9] - 2018-07-23
### Added
- Adding Recaptcha - Adding note here as work was done in develop

## [1.26.8] - 2018-07-04
### Changed
- Update WP_ENV checks to use CONSTANTS not relying on super globals

## [1.26.7] - 2018-06-28
### Changed
- Add Cookie Group ID to the ZenDesk chat script tag (see README.md)
- Move Browser Upgrade notification script from app.js to Tag Manager

## [1.26.6] - 2018-06-28
### Changed
- Tag Manager environment based loading

## [1.26.5] - 2018-06-27
### Added
- OneTrust cookie banner with styles

## [1.26.4] - 2018-06-18
### Changed
- Update repository URLs to GitHub from Beanstalk

## [1.26.3] - 2018-06-06
### Fixed
- Move button modifier class `btn--red` from conditional-buttons to template call in location-buildings.php

## [1.26.2] - 2018-06-04
### Added
- Add option to hide sections on Location pages
### Changed
- Force red button on the Dublin building listing page at client request

## [1.26.1] - 2018-05-18
### Added
- Add Bing Webmaster tools XML file to allow client to verify against Bing WMT

## [1.26.0] - 2018-04-19
### Added
- Redirection Plugin, via Composer

### Changed
- Removed "building." from page titles.
- Prevent IP Address collection in Gravity Forms.
- Update PPC ID feature to allow for multiple campaign IDs per building.
  These are used as query strings in location pages to show/hide buildings.

### Fixed
- Removed whitespace character from 404 page.
- Show FAQs button for buildings hosted externally.

## [1.25.3] - 2018-04-16
### Changed
- Updated the <meta> tag used to verify the site with Norton Safeweb.

## [1.25.2] - 2018-04-16
### Added
- Added a <meta> tag to verify the site with Norton Safeweb.

## [1.25.1] - 2018-02-26
### Added
- Added a class for highlighting nav menu links.

## [1.25.0] - 2018-02-07
### Changed
- Updated WP Migrate DB Pro to 1.8.1 and the media files addon to 1.4.9

## [1.24.0] - 2017-10-30
### Added
- Added the ability to change 'Rent amount Per Week' copy on Room post types

### Changed
- Dropped gtranslate functionality for language menu switcher.  
  Added fields in site options that allow admin to manually add languages

## [1.23.1] - 2017-09-22
### Fixed
- Removed the `images-loaded` plugin as it was causing Room carousel images to not load.

## [1.23.0] - 2017-09-22
### Fixed
- Fix in `rimg-bg.js`:
-- Image source was being set before the correct source was selected, resulting in an empty source for `background-image`.
-- To fix this, the plugin `images-loaded` has been implemented, which waits for the image to load before setting it.
-- We have also added a check for an empty `src` - if it's empty, we fall back to the legacy source.

## [1.22.1] - 2017-08-07
### Fixed
- Reduce quality setting on Rooms images to stop overloading server
- Ensure all `wpthumb` calls are CDNified.

## [1.22.0] - 2017-08-07
### Fixed
- Set high res fallback image for legacy browsers which cannot interprety `srcset`. Previously legacy were receiving the `src` which was tiny.
- Remove unwanted `console.log`
- Fix linting warnings

## [1.21.2] - 2017-07-06
### Fixed
- Ensure we have acutally removed the GMAPS API key constant from Production env config as it's now in Application wide config.

## [1.21.1] - 2017-07-06
### Changed
- Update Google Maps API to fresh version from `apikeys@mrbandfriends.co.uk`

## [1.21.0] - 2017-07-05
### Fixed
- Stub Room rewrites with end of string char to fix SEO title breaking issue Previous commits tried to resolve this issue by reversing the order of rewrites. That broke everything. This solution ensures that the rewrites match only the exact room slug and not when that room slug appears within another room slug (eg: /studio/ vs /studio-ultra-plus/). BC ticket: https://basecamp.com/1926511/projects/10607057/todos/313421833

## [1.20.2] - 2017-06-27
### Fixed
- Revert SEO title fix to rewrite rules as this caused breaking knock on effects

## [1.20.1] - 2017-06-26
### Changed
- Spritesheet to a new version name so the file is "busted" on the server cache

## [1.20.0] - 2017-06-26
### Fixed
- Fixes SEO title not working. Incorrect room Post was being returned. This fixes that.

## [1.19.5] - 2017-06-23
### Changed
- Fixed roomlist hover/focus styles
- Fixed new page Ajax loaded posts from including draft posts

## [1.19.4] - 2017-06-23
### Changed
- Updated footer with new UCAS mark
- Updated staging site IP


## [1.19.1 - 1.19.3] - 2017-06-01

This release covers the process of upgrading the `johnpbloch/wordpress` composer package. It requires a very quick fix and deploy process so these hotfixes cover that process.

## [1.19.0] - 2017-06-01

This should have been a hotfix but commits were made to `develop` by one of the team so we elected to run a release for the sake of simplicity.

### Added
* Added `deploy_after` hook to post deployment update to Slack channel via web hooks

### Changed
* Reduce number of releases kept on server to `3` to save on disk space.

### Fixed
* Ensure validation errors displayed below `select` elements are visually positioned away from the field itself.

## [1.18.1] - 2017-05-10

### Fixed
* Ensure slug is always returned from `wp_unique_post_slug` otherwise you cannot update the slug __anywhere__

## [1.18.0] - 2017-05-10

Upgrade of `1.17.0` to enable duplicate slugs for the individual Rooms. This is highly experimental but has been tested and appears to be solid.

### Added
* Disable standard WP restriction on duplicate slugs for “Rooms” post type only.
* Detect all Room posts with duplicate slugs and automatically create “hard coded” rewrite rules for each.
* Hard coded rewrite rules auto re-generated each time a “Room” post is updated.


## [1.17.0] - 2017-04-19

Major restructure of Location/Building/Room url structure. Now in format: `/locations/{{location}}/{{building}}/{{room}}/`.

### Added
* Restructure URLs via custom rewrite rules and altering permalinks as required.
* Update 301 redirects on the server to handle update.

## [1.16.9] - 2017-04-13

### Fixed
* Ensure Home Promo will display even if CTA isn't defined. Includes optional open in new tab.

## [1.16.8] - 2017-04-11

### Added
* Add favicon to web route because it appears to be requested by default.

### Changed
* Re-add Promo area to homepage - work originall completed in `develop`. This may cause merge conflicts later. Be careful.

## [1.16.7] - 2017-04-10

### Changed
* Client request - force all checkboard status to be based on the total number of connected buildings, not taking into account the "status" of those buildings.
* Add Promo area to homepage

## [1.16.6] - 2017-04-03

### Fixed
* Reinstate ACF fields previously lost. Fields were lost due to faliure to sync fields. Reinstated fields:
  * disable_am_i_feeling_lucky
  * checkerboard_image

## [1.16.5] - 2017-04-03

### Fixed
* Reinstate Location Title 1 & 2 fields. Previously lost somehow.

### Changed
* Ensure "Coming Soon" status counts as being "Available" on checkboard

## [1.16.4] - 2017-03-24

### Fixed
* Refactor Locations checkboard logic - now utilises global availability utility function to check status of all Buildings within Location. Also accounts for situation where Location has no available buildings.

## [1.16.3] - 2017-03-23

### Fixed
* Remove 404'ing assets.

## [1.16.2] - 2017-03-15

### Fixed
* Cancellation policy not showing due to malplaced conditional.

## [1.16.1] - 2017-03-09

### Fixed
* "Join Waiting List" button was relying on a presentational version of the Building name rather than the name of the actual Post. Correct to use the non-presentational name.

## [1.16.0] - 2017-03-09

### Fixed
* Favourites functionality bug where return value of availability function was not being handled correctly by the Ajax PHP functions.
* Fix IE11 bug with Custom Events being fired. Resolves bug with Favouriting functionality. Added polyfill to solve this.
* Correct layout on In page nav - https://basecamp.com/1926511/projects/10607057/todos/295438609

### Changed
* Remove red tint on checkboard images.
* Allow user to select a custom checkboard image on a per Location basis (see above)
* Featured Building upgrade. Ability to use custom content or select an existing building  - https://basecamp.com/1926511/projects/10607057/todos/297758419
* Update page anchor from `#details` to `#facilities`


## [1.15.2] - 2017-03-08

### Changed
* Update WP core and Plugins due to security concerns
* Allow minor and patch releases to WP on Production

## [1.15.1] - 2017-02-22

### Fixed
- Re-enable dual titles for Building Location. Fixed bug where the field was single (‘location_title’) but the template was still expecting dual fields (location_title_1 and location_title_2).

## [1.15.0] - 2017-02-21

### Added
- All "Show Flat" as option to map filter/types
- Add optional Building level Social links
- Add new page anchor IDs as requested by client

### Changed
- Remove heading from `<nav>` element. Not required and messing with Accessbility and SEO.
- Refactor "Availability" logic and code organisation. Now include "Join Waiting List" button when building is "Coming Soon"
- Reinstate dual facitilies title approach
- Do not display map filters for which there are no markers
- Update Food to Eating and Drinking in ACF fields for Map Pin type. Client request

### Fixed
- Ensure contact page hash responds to all cases
- Ensure Room anchors use the correct hash links
- Remove validation from ACF fields
- Ensure full building address is pulled through into green box at top of page
- Layout/display of green infobox on mobile
- Ensure footer social icons are available on mobile
- Fix footer overflow issue caused by fixed height on Testimonial wall

## [1.14.1] - 2017-02-17

### Fixed
- Building was misisng the `building_email_address` field from the ACF JSON but the data was still available. Sync'd all fields and re-created field.

## [1.14.0] - 2017-02-06

### Fixed
- All of Fernando's list of changes, except for work on maps and anchor links for contact accordion

## [1.13.2] - 2017-01-13

### Fixed
- remove debugging output

## [1.13.1] - 2017-01-13

### Changed
- Update WP and Plugins
- Remove "Shops" from POI on maps
- Update Trellis config for local dev

## [1.13.0] - 2017-01-12

### Fixed
- Testimonials grid fixed in IE11. Simplified and removed JS requirement.
- Ensure only first Slick slide is shown until it's fully initialised. Avoids horrible "jump" and unstyled look on
page load.

### Added
- Add `Buildings` to map markers on Room page.
- Pull Building on to Map on Room page.
- Ability to preselect "Add to Waiting List" (only) from Enquiry type dropdown on Contact page via query string params
- Ability to preselect any value from the "Choose hall to contact" dropdown on Contact page via query string params
- Show "Join Waiting List" button if Building status is Sold Out - shows on `/locations/{{location}}` page. Creates a deep link to auto select values on the Enquiry Form. __Note__: this requires that the values in the dropdown match up exactly with the values in the url which in turn are dynamically generated in the format `{{Location}}{{ Building Name }}` (slugified).
- __CMS__: Add `js-enquiry-hall` class to "Choose a hall to contact" field
- __CMS__: Add `js-enquiry-type` class to "Your enquiry type" field
- Ability to link to FAQs page from Building

### Changed
- Update deep link "hash" to allow human friendly urls for links on Location Buildings page


## [1.12.0] - 2016-12-16

### Fixed
- Ensure Carousel Infobox is positioned correctly on small height viewports
- Fix to email address not wrapping in IE11
- Remove small markup bugs causing IE11 errors

## [1.11.1] - 2016-11-24

### Added
- Instruction for PPC ID field


## [1.11.0] - 2016-11-24

Added directions into map tooltips, pin for each building and filter
locations buildings by PPC ID.

### Added
- Helper function for setting building availability for all rooms.
- Map "Host red" pin for each building
- Map pins tooltip now has directions link in it
- Updated footer text
- Ability to filter locations buildings using a PPC ID

### Fixed
- Fixed issue with vertical stacked gallery on single uni pages
- Fixed spelling and added colon on room pages booking component


## [1.10.4] - 2016-11-15

### Fixed
- Fixed IE bug with gallery min height
- Fixed header carosuel by using Slick Slider to handle the JS


## [1.10.3] - ?

### Fixed
- Added modifier for min height of gallery

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
