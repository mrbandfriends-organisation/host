var magnificPopup = require('magnific-popup');

module.exports = function()
{
    "use strict";

    $('.js-popup-gallery-trigger').magnificPopup({
        type: 'image',
        gallery:{
            enabled:true
        },

        callbacks: {
           markupParse: function(template, values, item) {
               template.find('.mfp-content').addClass('bad-site-class');
           }
        }
    });
};
