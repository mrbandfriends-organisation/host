require('magnific-popup');


module.exports = function()
{
    "use strict";

    $('.js-popup-gallery-trigger').magnificPopup({
        type: 'image',
        gallery:{
            enabled:true
        }
    });

}();
