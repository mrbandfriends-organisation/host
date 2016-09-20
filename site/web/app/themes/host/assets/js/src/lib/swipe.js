var defaultOptions = {
    iSuppressScrollAfter: 10,       // Vertical pixels before scrolling is blocked
    iMaximumTime:         1000,     // time in microseconds before swipe is declared invalid
    iMinHorizontalAmount: 30,       // minimum horizontal distance before a swipe is triggered
    iMaxVerticalAmount:   75        // maximum vertical distance below which we trigger a swipe
};


function enableSwipe(el, options)
{
    "use strict";

    var oStart = null;
    var oEnd   = null;

    /**
     * Fires a custom event on the current element.
     */
    function fireEvent(sEvent)
    {
        // 1. create custom event object
        var oEvt;
        if (window.CustomEvent)
        {
            oEvt = new CustomEvent(sEvent);
        }
        else
        {
            oEvt = document.createEvent('CustomEvent');
            oEvt.initCustomEvent(sEvent, true, true);
        }

        // 2. and fire it
        el.dispatchEvent(oEvt);
    }

    /**
     * TouchEnd handler
     */
    function fnTouchEnd(ev)
    {
        // 1. unbind everything
        el.removeEventListener('touchmove', fnTouchMove);
        el.removeEventListener('touchend',  fnTouchEnd);

        // 2. if it was quick enough, and is was more than the threshhold(s)
        if (((oEnd.time - oStart.time) < options.iMaximumTime) &&
            (Math.abs(oStart.position.x - oEnd.position.x) > options.iMinHorizontalAmount) &&
            (Math.abs(oStart.position.y - oEnd.position.y) < options.iMaxVerticalAmount))
        {
            // a. base swipe event
            fireEvent('swipe');

            // b. swipe left/right
            if (oEnd.position.x > oStart.position.x)
            {
                fireEvent('swiperight');
            }
            else
            {
                fireEvent('swipeleft');
            }
        }

        // 3. clear everything
        oStart = null;
        oEnd   = null;
    }

    /**
     * TouchMove handler
     */
    function fnTouchMove(ev)
    {
        // 1. get touch position
        var oTouch = ev.touches[0];

        // 2. store current position
        oEnd = {
            position: { x: oTouch.pageX, y: oTouch.pageY },
            time:     new Date().getTime()
        };

        // 3. if we’ve moved far enough, cancel any scrolling
        if (Math.abs(oStart.position.x - oEnd.position.x) > options.iSuppressScrollAfter)
        {
            ev.preventDefault();
            return false;
        }

        return true;
    }

    /**
     * TouchStart handler
     */
    function fnTouchStart(ev)
    {
        // 1. get the current touch
        var oTouch = ev.touches[0];

        // 2. store the start of the touch
        oStart = {
            position: { x: oTouch.pageX, y: oTouch.pageY },
            time:     new Date().getTime()
        };
        oEnd = null;

        // 3. bind move and stop
        el.addEventListener('touchmove', fnTouchMove);
        el.addEventListener('touchend',  fnTouchEnd);
    }

    // bind everything
    el.addEventListener('touchstart', fnTouchStart);

    // pass back
    return;
}

module.exports = function(el)
{
    "use strict";

    // 0. get default options
    var options = defaultOptions;

    // 1. if there’re options being passed in…
    if (arguments.length === 2)
    {
        for (var k in arguments[1])
        {
            if (arguments[1].hasOwnProperty(k))
            {
                options[k] = arguments[1][k];
            }
        }
    }

    // 2. call
    return enableSwipe(el, options);
};
