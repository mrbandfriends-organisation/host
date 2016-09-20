
var debounce = require('lodash.debounce');

function Slideshow()
{
    "use strict";

	var el           = this;
	var elCarousel   = this.querySelector('.js-slideshow__list');
    var aElItems     = this.querySelectorAll('.js-slideshow__item').toArray();
    var iCurrent     = 0;
    var iNumSlides   = aElItems.length;
    var iItemWidth   = -1;
    var iToShow      = 0;
    var sPagination  = (this.getAttribute('data-pagination') || "").toLowerCase();
    var aoPagination = [];
    var aoMirrors    = [];
    var iMirrorOff   = 0;

    /**
     * Gets the closest index to the requested page.
     */
    function getDistanceToClosestPage(iPage)
    {
        // 1. work out the distance from where we are to where we want to be
        var iDistance = iPage - (iCurrent % iNumSlides);

        // 2. if the magnitude is greater than half the number of slides (ie, it’s closer to ‘wrap’)
        if (Math.abs(iDistance) > (iNumSlides / 2))
        {
            // a. if it’s positive, subtract the number of slides
            if (iDistance > 0)
            {
                iDistance -= iNumSlides;
            }
            // b. otherwise, add
            else
            {
                iDistance += iNumSlides;
            }
        }

        return iDistance;
    }

    function offsetToIndex(iOff)
    {
        return (iOff + aElItems.length) % aElItems.length;
    }

    /**
     * Repositions all the slides in the slideshow.
     */
    function reposition()
    {
        // 1. work out the first item we need to show within the viewport
        var iFirst  = iCurrent - Math.floor((aElItems.length - 1) / 2);
        var iLast   = iFirst + aElItems.length;

        // 2. position everything
        var sTranslate = '0';
        var iIndex = 0;
        for (var i = iFirst; i < iLast; i++)
        {
            // a. calculate translation offset
            if (i < iCurrent)
            {
                sTranslate = (0 - iItemWidth)+'px';
            }
            else if (i > iCurrent)
            {
                sTranslate = iItemWidth+'px';
            }
            else
            {
                sTranslate = 0;
            }

            // b. get the index of the DOM
            iIndex = offsetToIndex(i);

            // b. set it
            aElItems[iIndex].style.transform = 'translateX('+sTranslate+')';

            // c. also set windowed class
            if (Math.abs(i - iCurrent) > 1)
            {
                aElItems[iIndex].classList.add('js-slideshow--outside');
            }
            else
            {
                aElItems[iIndex].classList.remove('js-slideshow--outside');
            }
        }

        // 3. poke the pagination
        var iActualPage  = iCurrent % iNumSlides;
        aoPagination.forEach(function(oPagination)
        {
            oPagination.update(iActualPage, iActualPage, 1);
        });
    }

    /**
     * Slews to the appropriate slide
     */
    function go(iPage)
    {
        // 1. update our pointer
        iCurrent = (iCurrent + getDistanceToClosestPage(iPage) + aElItems.length) % aElItems.length;

        // 2. slew
        reposition();

        // 3. push to mirrors
        aoMirrors.forEach(function(oMirror)
        {
            oMirror.go(iPage + iMirrorOff);
        });
    }

    /**
     * Similar to go(), but performs an incremental step
     */
    function step(iDistance)
    {
        // 1. update our pointer
        iCurrent = (iCurrent + iDistance + aElItems.length) % aElItems.length;

        // 2. slew
        reposition();

        // 3. push to mirrors
        aoMirrors.forEach(function(oMirror)
        {
            oMirror.step(iDistance);
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
            var oPagination = require('slideshow/'+sPagination+'-pagination')({
                elRoot:    el,
                iNumItems: iNumSlides,
                fnGo:      go,
                fnStep:    step
            });

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

        // 3. get an offset
        if (oMirrorConfig.offset !== undefined)
        {
            iMirrorOff = parseInt(oMirrorConfig.offset, 10);
        }
    }

    /**
     * Duplicates slides
     */
    function duplicateSlides()
    {
        // 1. work out how many times we need to run
        var iDupesRequired = Math.floor(5 / iNumSlides);

        // 2. duplicate
        while (iDupesRequired-- > 0)
        {
            aElItems.forEach(function(el)
            {
                el.parentNode.appendChild(el.cloneNode(true));
            });
        }

        // 3. reindex
        aElItems = el.querySelectorAll('.js-slideshow__item').toArray();
    }

    function bindSwipes()
    {
        // 1. enable swiping
        require('swipe')(el);

        // 2. event handler
        el.addEventListener('swipeleft', function()
        {
            step(1);
        });
        el.addEventListener('swiperight', function()
        {
            step(-1);
        })
    }

    /**
     * Constructor
     */
    return (function()
    {
        // 0. if there’s nothing doing…
        if (iNumSlides < 2)
        {
            return null;
        }

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

        // 3. if we need to duplicate things, do so
        if (iNumSlides < 5)
        {
            duplicateSlides();
        }

        // 3. bind to debounced resize
        window.addEventListener('resize', debounce(assessDimensions, 100));

        // 4. set everything up
        assessDimensions();

        // 5. go places
        go(0);

        // 6. and a class, if it pleases thee
        setTimeout(function()
        {
            el.classList.add('js-slideshow--active');
        }, 10);

        // 7. bind to swipe
        bindSwipes();

        // 8. return some hooks for mirrors
        return {
            go:   go,
            step: step
        };
    })();
}


module.exports = Slideshow;
