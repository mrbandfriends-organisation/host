/**
 * Inview checker
 */

var verge    = require('verge');
var debounce = require('lodash.debounce');

$.extend(verge);

var defaults = {
    classes: {
        add:    'js-inview',
        first:  'js-inview--shown',
        inview: 'js-inview--current'
    },
    timeout:   50,
    tolerance: 0
};

function InviewChecker(selector)
{
    "use strict";

    var aoBound = [];
    var options = $.extend(true, defaults, (arguments.length === 2 ? arguments[1] : {}));

    function handleActivity()
    {
        // run through and do things
        aoBound.each(function()
        {
            // a. grab and check
            var oCurr   = $(this);
            var bInview = $.inViewport(this, 0 - options.tolerance);

            // b. bounce classes
            if (bInview)
                oCurr.addClass(options.classes.first);
            oCurr.toggleClass(options.classes.inview, bInview);
        });

    }

    return (function()
    {
        // 1. get our victims
        aoBound = $(selector).addClass(options.classes.add);

        // 2. bind resize to debounce
        $(window).on('DOMContentLoaded load resize scroll', debounce(handleActivity, options.timeout));
    })();
}

module.exports = InviewChecker;
