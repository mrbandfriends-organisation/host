require('slick-carousel');
module.exports = function()
{
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
}
