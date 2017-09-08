/* jshint strict: false */
/**
 * RESPONSIVE IMAGES BACKGROUNDS
 * utility to allow for true responsive images on CSS backgrounds
 * when the srcs are coming from a content management system.
 *
 * Relies on native Responsive Image implementation to parse the image
 * details from the srcset attribute and set them on the wrapping element's
 * style attribute.
 *
 * Assumes you will set
 * background: no-repeat 50% 50%; background-size: cover;
 */

var RImgBg = function( selector ) {
    "use strict";

    this.selector   = selector;
    this.$selector  = $(selector);

    if (!this.$selector.length) {
        return false;
    }

    this.init();

};

RImgBg.prototype.init = function() {
    var self = this;
    this.$selector.each(function() {

        var $this = $(this);

        // Grab the first image which has a srcset
        var targetImg = $this.children('img').eq(0);
       
        
        if (targetImg === undefined) {
            return;
        }
            // Grab the currentSrc from the src set
            var currentSrc = "";

        $this.parent().imagesLoaded( { background: true }, function() {
            
            if (targetImg[0].currentSrc !== undefined) {
                currentSrc = targetImg[0].currentSrc;
            } else if (targetImg.data('legacy-src') !== undefined) {
                currentSrc = targetImg.data('legacy-src');
            } else {
                currentSrc = targetImg[0].src;
            }

            // Set the CSS background via inline style
            self._setBgImg($this, currentSrc);
            
        });

        // Remove the original image from the DOM
        targetImg.hide();
    });
};


RImgBg.prototype._setBgImg = function(el, src) {
    el.css('background-image', 'url(' + src + ')');
};


// Export
module.exports = RImgBg;
