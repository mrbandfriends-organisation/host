/**
 * APPLICATION JAVASCRIPT
 *
 * base JavaScript entry point
 * utilises Browserify for dependency management
 */

// NPM Modules
//require('es5-shim');
require('modernizr');
require('jquery');
window.$ = require('jquery');


/**
 * GOGGLE EVENT TRACKING
 * provides ability to fire GA events by applying data- attributes
 * to DOM elements. Requires "ga" object to be in global scope
 */
(function() {
    "use strict";
    // var GAEventTracking = require('ga-event-tracking.js');

    // // Initialise with selector
    // new GAEventTracking('.js-ga-tracking');
}());


/**
 * WEBFONT LOADING
 * managing loading of webfonts here to assist with
 * managing of FOUT/FOIT
 */
(function() {
    "use strict";

    // Shimmed via package.json
    var WebFont = require('webfontloader');

    WebFont.load( {
        custom: {
            families: ['']
        },
        timeout: 2000 // if nowt happens then bail out
    });
}());

/**
 * SVG SPRITEMAP
 * loads SVG spritemap into the DOM for use with <use>
 */
(function() {
    "use strict";

    var SVGSpritemapLoader = require('svg-spritemap-loader.js');

    new SVGSpritemapLoader('assets/svg/sprites/output/spritesheet.svg');
}());


/**
 * *CANVAS
 * manages the toggling of off canvas menu
 */
(function() {
    "use strict";

    if ( Modernizr.mq( '(max-width: 992px)' ) ) {
        // Async load
        require.ensure(['offcanvas-toggler'], function() {
            var OffCanvasToggler = require('offcanvas-toggler');
            new OffCanvasToggler();
        },'offcanvas-toggle');
    }

}());

/**
 * RESPONSIVE CSS IMAGE BACKGROUNDS
 */
(function() {
    'use strict';
    var RImgBg = require('rimg-bg.js');
    new RImgBg('.js-rimgbg');
}());

/**
 * INVIEW
 * checks whether an element is within the Viewport
 * if so, then applies the 'in-view' class
 */
(function() {
    "use strict";

    //var InViewChecker = require('inview-checker.js');

    //new InViewChecker('.js-inview');
}());
