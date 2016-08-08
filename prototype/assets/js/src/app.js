/**
 * APPLICATION JAVASCRIPT
 *
 * base JavaScript entry point
 * utilises Browserify for dependency management
 */

// NPM Modules
require('expose?$!expose?jQuery!jquery');
require('jquery.debounce');


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

    if ( $('.js-offcanvas-toggle').is(':visible') ) {
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

/**
 * UI code
 *
 * There really shouldn’t be anything here other than require()-ing bits of code in the 'ui' dir. If there is logic
 * code here, use git blame to find out who is buying the beers this week…
 */
(function()
{
    "use strict";

    require('checkerboard');

    require('maps')();
})();
