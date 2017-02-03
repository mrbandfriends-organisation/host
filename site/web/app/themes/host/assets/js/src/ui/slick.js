require('slick-carousel');

/**
 * SHUFFLE
 * shuffle some DOM elements
 * https://css-tricks.com/snippets/jquery/shuffle-dom-elements/
 */
(function($){ 
    $.fn.shuffle = function() {
 
        var allElems = this.get(),
            getRandom = function(max) {
                return Math.floor(Math.random() * max);
            },
            shuffled = $.map(allElems, function(){
                var random = getRandom(allElems.length),
                    randEl = $(allElems[random]).clone(true)[0];
                allElems.splice(random, 1);
                return randEl;
           });
 
        this.each(function(i){
            $(this).replaceWith($(shuffled[i]));
        });
 
        return $(shuffled);
 
    }; 
})(jQuery);


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

    (function() {
        /**
         *  SLICK HEADER CAROSUEL
         */
        
        var carousel        = $('.js-slick-header-carousel');
        var shouldShuffle   = carousel.data('shuffle');
        var slides          = carousel.find('.js-slick-header-carousel-slide')

        if (shouldShuffle) { // if marked as ranomise in CMS then shuffle the slides prior to init slick
            slides.shuffle();
        }

        $('.js-slick-header-carousel').slick({
            arrows: true,
            dots: true,
            infinite: true,
            mobileFirst: true,
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        draggable: false
                    }
                }
            ]
        });
    }());
}
