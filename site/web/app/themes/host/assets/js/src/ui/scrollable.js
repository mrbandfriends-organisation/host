require('perfect-scrollbar/jquery')($);

module.exports = function()
{
    "use strict";

    // If is large viewport or up use perfectScrollbar
    if ( window.innerWidth > 990 ) {
        $('.js-scrollable').perfectScrollbar();
    }

    // If its a smaller viewport
    else {

        // 1. Add class to allow for unlimited max height
        var scrollable = document.querySelector('.js-scrollable');
        scrollable.classList.add("scrollable--mobile");

        // 2. If there are more than 3 locations then hide
        //    all locations above 3
        if (scrollable.children.length > 3) {
            for (var i = 3; i < scrollable.children.length; i++) {
                scrollable.children[i].classList.add("vh");
            }
        }
    }

};
