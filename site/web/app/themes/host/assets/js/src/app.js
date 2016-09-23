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

    new SVGSpritemapLoader('/app/themes/host/assets/svg/sprites/output/spritesheet.svg');
}());


/**
 * *CANVAS
 * manages the toggling of off canvas menu
 */
(function() {
    "use strict";

    // Async load
    if ( window.innerWidth < 992 ) {
        // Async load
        //require.ensure(['offcanvas-toggler'], function() {
            var OffCanvasToggler = require('offcanvas-toggler');
            new OffCanvasToggler();
        //},'offcanvas-toggle');
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

    require('contact-tabs');

    require('maps')();

    require('flyouts')();

    require('slideshows')();

    require('scrollable')();

    // require('bind-inview')();

    // require('onpage-smooth-scroll')();

    require('lightbox')();

    require('equality')();

    require('FavouriteManager');

    //require('slick')();
})();



/**
 * AJAX POSTS LOADING
 * initalise posts "load more" module
 */
(function() {
   'use strict';

    if ( $('.js-posts-loader-container').length ) {
        // Async load

        //require.ensure(['posts-loader'], function() {
            var PostsLoader = require('posts-loader');
            new PostsLoader({
                'dataEndpoint' : 'host_load_posts'
            });
        //},'posts-loader');
    }

}());
