/**
 * APPLICATION JAVASCRIPT
 *
 * base JavaScript entry point
 * utilises Browserify for dependency management
 */

// NPM Modules
require('expose?$!expose?jQuery!jquery');

// extend things
require('./ext/NodeList');

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

    require('flyouts')();

    require('slideshows')();

    require('scrollable')();

    // require('bind-inview')();
})();
