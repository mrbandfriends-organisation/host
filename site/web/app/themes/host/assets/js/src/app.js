"use strict";

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
require('./ext/CustomEvent');

// Promise polyfill
// https://github.com/taylorhakes/promise-polyfill
var PromisePolyfill = require('promise-polyfill');
window.Promise = window.Promise || PromisePolyfill;
var setAsap = require('setasap');
Promise._immediateFn = setAsap;

// Breakpoint Manager
var bpm = require('breakpoint-tools');


/**
 * GOGGLE EVENT TRACKINGd
 * provides ability to fire GA events by applying data- attributes
 * to DOM elements. Requires "ga" object to be in global scope
 */
(function() {
    // var GAEventTracking = require('ga-event-tracking.js');

    // // Initialise with selector
    // new GAEventTracking('.js-ga-tracking');
}());

/**
 * SVG SPRITEMAP
 * loads SVG spritemap into the DOM for use with <use>
 */
(function() {

    var SVGSpritemapLoader = require('svg-spritemap-loader.js');

    new SVGSpritemapLoader( LOCALISED_VARS.stylesheet_directory_uri + '/assets/svg/sprites/output/spritesheet-v2.svg');
}());


/**
 * *CANVAS
 * manages the toggling of off canvas menu
 */
(function() {

    // Async load
    if ( bpm.matchSmaller('large') ) {
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
    var RImgBg = require('rimg-bg.js');
    
    new RImgBg('.js-rimgbg');
    
}());

/**
 * UI code
 *
 * There really shouldn’t be anything here other than require()-ing bits of code in the 'ui' dir. If there is logic
 * code here, use git blame to find out who is buying the beers this week…
 */
(function() {

    require('webfonts');

    require('checkerboard');

    require('contact-tabs');

    require('flyouts')();

    require('slideshows')();

    require('scrollable')();

    // Switched out for fixed height
    //require('equality')();

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
(function() {
    $(window).on('load',function() {
        var gadget;
        var targetString = ( bpm.matchLarger('large') ) ? 'google-translate-target-large' : 'google-translate-target-small';

        var googleTranslateTarget = $('#' + targetString);


        window.googleLanguageTranslatorInit = function() {
           new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages:'en,zh-CN',
                layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL,
                multilanguagePage: true,
                autoDisplay: false
            }, targetString);

            // Improve layout
            googleTranslateTarget.find('div').css('display','block');

            gadget = googleTranslateTarget.find('.goog-te-gadget');

            // Remove Google logo and span
            gadget.children().not('div').remove();

            // Remove "powered by" text nodes
            gadget.contents().filter(function() {
                return this.nodeType === 3;
            }).remove();

            // Remove loading placeholder
            googleTranslateTarget.find('.js-translation-loading-placeholder').remove();


        };
        require('fg-loadjs')('//translate.google.com/translate_a/element.js?cb=googleLanguageTranslatorInit');
    });
}());

/**
 * LIGHTBOX
 * conditionally loaded lightbox
 */
(function() {
    $(window).on('load',function() {
        if ( $('.js-popup-gallery-trigger').length ) {
            require.ensure(['lightbox'], function() {
                require('lightbox')();
            },'lightbox');
        }
    });
}());


/**
 * PANORAMA LIGHTBOX
 *
 */
(function() {
    $(window).on('load',function() {
        var triggers = $('.js-room-panorama-trigger');
        if ( triggers.length ) {
            require.ensure(['magnific-popup'], function() {
                var magnific = require('magnific-popup');

                triggers.magnificPopup({
                    type: 'iframe',
                });
            },'magnific-popup');
        }
    });
}());


/**
 * BROWSER UPGRADE NOTICE
 */
(function() {
    var $buoop = {c:2};

    function $buo_f(){
        setTimeout(function() {
            var e = document.createElement("script");
            e.src = "//browser-update.org/update.min.js";
            document.body.appendChild(e);
        }, 3000);
    }
    $(window).on('load', $buo_f);
}());


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


/**
 * AUTO SELECT ENQUIRY PROPERTY AND HALL
 * allows deep linking to the Contact form with particular values
 * selected via JS. This is used from the locations listing page
 * when you click the "join the waiting list" button
 */
(function(){
    var queryString         = require('query-string');
    var contactForm         = $('#gform_1');

    var queryObject         = queryString.parse(window.location.search);
    var enquiryField        = contactForm.find('.js-enquiry-type');
    var enquiryHallField    = contactForm.find('.js-enquiry-hall');
    var waitingListOption   = enquiryField.find('option[value="Add to Waiting List"]').first();



    if ( !contactForm.length ) {
        return;
    }

    if (queryObject !== undefined ) {

        if(queryObject["enquiry-type"] !== undefined && queryObject["enquiry-type"] === LOCALISED_VARS.waiting_list_field) {
            waitingListOption.prop('selected', true);
        }

        if(queryObject["enquiry-hall"] !== undefined) {
            enquiryHallField.find('option[value="' + queryObject["enquiry-hall"] + '"]').first().prop('selected', true);
        }
    }
}());


/**
 * FORCE SCROLL TO ANCHORS
 * lazy loading of images causes lots of inaccurate scrolling when
 * the browser is handling in page anchors. This typically only effects
 * the initial page load. The following caters for this by manually
 * scrolling the page to the intended target under all circumstances
 * once the page has fully loaded
 */
(function(){
    $( window ).on('load', function() {
        var hash = window.location.hash;

        if ( hash.length ) {
            var target = $(hash.toLowerCase());

            if (target.length) {
                setTimeout(function() { // force scroll to happen
                    var offset = target.offset().top;
                    window.scrollTo(0, offset);
                }, 0);
            }

        }
    });
}());
