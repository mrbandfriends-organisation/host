
var debounce = require('lodash.debounce');

function Slideshow()
{
    "use strict";

	var el           = this;
	var elCarousel   = this.querySelector('.js-slideshow__list');
    var aElItems     = this.querySelectorAll('.js-slideshow__item').toArray();
    var iCurrent     = (aElItems.length > 2) ? 1 : 0;
    var iItemWidth   = -1;
    var iToShow      = 0;
    var sPagination  = (this.getAttribute('data-pagination') || "").toLowerCase();
    var aoPagination = [];
    var aoMirrors    = [];
    var iMirrorOff   = 0;

    /**
     * Repositions all the slides in the slideshow.
     */
    function reposition()
    {
        // 1. work out the first item we need to show within the viewport
        var iFirst  = Math.max(0, Math.min(iCurrent - (Math.ceil(iToShow / 2) - 1), aElItems.length - iToShow));
        var iLast   = iFirst + iToShow - 1;
        var iOffset = 0 - (iFirst * iItemWidth);

        // 2. position everything
        aElItems.forEach(function(elSlide, idx)
        {
            // a. transform attr
            elSlide.style.transform = 'translateX('+((idx * iItemWidth) + iOffset)+'px)';

            // b. toggle ‘outside’ class
            if ((idx < iFirst || idx > iLast))
            {
                elSlide.classList.add('js-slideshow--outside');
            }
            else
            {
                elSlide.classList.remove('js-slideshow--outside');
            }
        });

        // 3. update the pagination modules
        aoPagination.forEach(function(oPagination)
        {
            oPagination.update(iCurrent, iFirst, iToShow);
        });
    }

    /**
     * Slews to the appropriate slide
     */
    function go(iPage)
    {
        // 1. update our pointer
        iCurrent = Math.max(0, Math.min(iPage, aElItems.length));

        // 2. slew
        reposition();

        // 3. push to mirrors
        aoMirrors.forEach(function(oMirror)
        {
            oMirror.go(iPage + iMirrorOff);
        });
    }

    /**
     * Builds pagination for the carousel
     */
    function buildPagination()
    {
        // 1. split everything out
        var aPagination = sPagination.split(/\s+/);

        // 2. iterate
        aPagination.forEach(function(sPagination)
        {
            // a. load the pagination
            var oPagination = require('slideshow/'+sPagination+'-pagination')(el, aElItems, go);

            // b. push it onto the array
            aoPagination.push(oPagination);
        });
    }

    /**
     * Assesses dimensions
     */
    function assessDimensions()
    {
        // 1. update the viewable width and number of items we can show
        iItemWidth = aElItems[iCurrent].scrollWidth;
        iToShow    = Math.floor(( elCarousel.scrollWidth / iItemWidth ) + 0.01);

        // 2. reset the heights
        elCarousel.style.height = "";
        aElItems.forEach(function(el) { el.style.height = ""; });

        // 3. get the new height
        var iNewHeight = elCarousel.scrollHeight;
        aElItems.forEach(function(el)
        {
            iNewHeight = Math.max(iNewHeight, el.scrollHeight);
        });

        // 4. set the new heights
        elCarousel.style.height = iNewHeight+'px';
        aElItems.forEach(function(el) { el.style.height = iNewHeight+'px'; });

        // 5. call reposition handler
        reposition();

        // 6. update pagination
        aoPagination.forEach(function(oPagination)
        {
            oPagination.toggle(iToShow < aElItems.length);
        });
    }

    /**
     * Set up any configured mirrors
     */
    function initMirrors()
    {
        // 1. get mirror configuration
        var oMirrorConfig = JSON.parse(el.getAttribute('data-mirror-to'));
        if (oMirrorConfig === false)
        {
            return;
        }

        // 2. get some DOMs and init them
        document.querySelectorAll(oMirrorConfig.selector).each(function(elTarget)
        {
            // a. clone the current node + strip the mirror + pagination attrs
            var elClone = el.cloneNode(true);
            elClone.removeAttribute('data-mirror-to');
            if (elClone.hasAttribute('data-pagination'))
            {
                elClone.removeAttribute('data-pagination');
            }

            // b. mark as a mirror (think a big ‘H’ on its forehead…)
            elClone.classList.add('js-slideshow__mirror');

            // c. append it to the target DOM
            elTarget.appendChild(elClone);

            // d. enhance!
            aoMirrors.push(Slideshow.call(elClone));

        });
    }

    /**
     * Constructor
     */
    return (function()
    {
        // 1. if we’re mirroring…
        if (el.hasAttribute('data-mirror-to'))
        {
            initMirrors();
        }

        // 2. build pagination
        if (sPagination !== "")
        {
            buildPagination();
        }

        // 3. bind to debounced resize
        window.addEventListener('resize', debounce(assessDimensions, 100));

        // 4. set everything up
        assessDimensions();

        // 6. and a class, if it pleases thee
        el.classList.add('js-slideshow--active');

        // 7. return some hooks for mirrors
        return {
            go: go
        };
    })();
}


module.exports = Slideshow;
