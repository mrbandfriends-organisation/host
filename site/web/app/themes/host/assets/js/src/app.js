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

var bpm = require('breakpoint-tools');



/**
 * GOGGLE EVENT TRACKINGd
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

    new SVGSpritemapLoader( LOCALISED_VARS.stylesheet_directory_uri + '/assets/svg/sprites/output/spritesheet.svg');
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

    require('webfonts');

    require('checkerboard');

    require('contact-tabs');    

    require('flyouts')();

    require('slideshows')();

    require('scrollable')();

    require('lightbox')();

    require('equality')();

    require('FavouriteManager');

    require('slick')();

    require('lazysizes');
})();


/**
 * GOOGLE TRANSLATION IMPLEMENTATION
 * originally the site used to rely on a Plugin but this included assets
 * in such a way as to block render. As a result we've reimplemented this
 * manually.
 */
$(window).on('load',function() {
    var gadget;
    var targetString = ( bpm.matchLarger('large') ) ? 'google-translate-target-large' : 'google-translate-target-small';

    var googleTranslateTarget = $('#' + targetString);


    window.googleLanguageTranslatorInit = function() { 
       new google.translate.TranslateElement({ 
            pageLanguage: 'en',
            includedLanguages:'en,zh-CN,zh-TW,fr,de,it,ja,pt,es',
            layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL, 
            multilanguagePage: true,
            autoDisplay: false
        }, targetString);

        // Improve layout
        googleTranslateTarget.find('div').css('display','block');

        gadget = googleTranslateTarget.find('.goog-te-gadget');

        // Remove Google logo and span
        gadget.children().not('div').remove()

        // Remove "powered by" text nodes
        gadget.contents().filter(function() {
            return this.nodeType == 3;
        }).remove();

        // Remove loading placeholder
        googleTranslateTarget.find('.js-translation-loading-placeholder').remove();

        
    };
    require('fg-loadjs')('//translate.google.com/translate_a/element.js?cb=googleLanguageTranslatorInit');
});






/**
 * LAZY LOADING BACKGROUND IMAGES
 * uses lazysizes to detect when element is inview and then
 * finds the image and loads it by adding style attribute
 * https://github.com/aFarkas/lazysizes
 */
(function() {
    document.addEventListener('lazybeforeunveil', function(e){
        var bg = e.target.getAttribute('data-bg');

        if(bg){
            e.target.style.backgroundImage = 'url(' + bg + ')';
        }
    });
}());


/**
 * GOOGLE MAPS 
 * initialises Google Maps functionality where a map is present
 */
(function() {
    if ( $('.js-map').length ) {
        require.ensure(['maps'], function() {
            require('maps')();
        },'google-maps');
    }
}());



/**
 * AJAX POSTS LOADING
 * initalise posts "load more" module
 */
(function() {
   'use strict';

    // here need to test if container exists
    // Depending which containe exitis depends on which instance of
    // Post loader is called
    if ( $('.js-news-post-loader').length ) {
        // Async load

        require.ensure(['posts-loader'], function() {
            var PostsLoader = require('posts-loader');
            new PostsLoader({
                'dataEndpoint'  : 'host_load_posts',
                'paginationUrl' : '/news/page/',
                'order'         : 'DESC',
            });
        },'posts-loader');
    }

    // uni if container exists
    if ( $('.js-university-post-loader').length ) {
        // Async load

        require.ensure(['posts-loader'], function() {
            var PostsLoader = require('posts-loader');
            new PostsLoader({
                'dataEndpoint'  : 'host_load_posts',
                'paginationUrl' : '/universities/page',
                'postType'      : 'university',
                'orderBy'       : 'title'
            });
        },'posts-loader');
    }
}());

/**
 * SALVATTORE
 * creates multicolumn Masonary-like layout
 */
(function(){
    if ( $('[data-columns]').length ) {
        require.ensure(['salvattore'], function() {  // lazy loaded
            // Needs to be set as a global on window directly...
            window.salvattore = require('salvattore');
        },'salvattore');
    }
}());
