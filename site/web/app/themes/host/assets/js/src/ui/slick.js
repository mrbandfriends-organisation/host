require('slick-carousel');
module.exports = function()
{
    "use strict";

    $('.js-slick-fade').slick({
        arrows: false,
        dots: true,
        infinite: true,
        speed: 500,
        fade: true,
        cssEase: 'ease-in-out',
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        responsive: [
            {
            breakpoint: 600,
            settings: {
                //arrows: true,
                dots: false
             }
           },
       ]
    });

    $('.js-slick-header-slider').slick({
        arrows: true,
        dots: true,
        infinite: true,
        speed: 500,
        //fade: true,
        cssEase: 'ease-in-out',
        slidesToShow: 1,
        slidesToScroll: 1,
        prevArrow: '<button type="button" class="slideshow-pagination__button slideshow-pagination__button--prev">Previous</button>',
        nextArrow: '<button type="button" class="slideshow-pagination__button slideshow-pagination__button--next">Next</button>',
    });
}
