var slideshow = require('slideshow/index');

module.exports = function()
{
    "use strict";

    document.querySelectorAll('.js-slideshow').each(function(el)
    {
        slideshow.call(el);
    });
};
