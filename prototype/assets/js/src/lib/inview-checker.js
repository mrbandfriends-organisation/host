/* jshint strict: false */
/**
 * INVIEW CHECKER
 * checks whether a selector is "in the viewport"
 * and applies a selector to the element when it's
 * in the view
 */

var verge       = require('verge');
var debounce    = require('lodash.debounce');


// Extend Verge.js as jQuery Plugin
// http://verge.airve.com/#integration
$.extend(verge);


var InViewChecker = function(selector, options) {
    this.$collection = $(selector);

    if ( !this.$collection.length ) {
        return false;
    }

    this.settings = $.extend({
        wait: 400,
        inViewClassName: 'is-inview'
    }, options);

    this._addListeners();
};


InViewChecker.prototype._addListeners = function() {
    var self = this;

    $(window).on('DOMContentLoaded load resize scroll', debounce(function() {
        self._checkInView();
    }, self.settings.wait));
};

InViewChecker.prototype._checkInView = function() {
    var className = this.settings.inViewClassName;
    this.$collection.each(function(e) {
        var $this = $(this);
        if ( $.inViewport( $this ) ) {
            $this.addClass(className);
        }
    });
};

// Export
module.exports = InViewChecker;
