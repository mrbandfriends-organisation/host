var bp = require('breakpoint-tools');

function Equality()
{
    "use strict";

    var elRoot      = this;
    var aElPanel    = [];
    var sBreakpoint = '';

    /**
     * Works out the content height of a given panel.
     */
    function getContentHeight(el)
    {
        // 0. setup
        var iHeight = 0;
        var iLastMg = 0;

        // 1. go through children
        var elChild = el.firstElementChild;
        var oStyle, iCurrMg;
        while (elChild !== null)
        {
            // a. get style object
            oStyle = window.getComputedStyle(elChild);

            // b. add the height of the container plus padding
            iHeight += parseInt(oStyle.height, 10);

            // c. add margin, based on previous bottom or current top and update the stat
            iCurrMg = (oStyle.marginTop !== undefined) ? parseInt(oStyle.marginTop, 10) : 0;
            iHeight += (iCurrMg > iLastMg) ? iCurrMg : iLastMg;
            iLastMg = (oStyle.marginBottom !== undefined) ? parseInt(oStyle.marginBottom, 10) : 0;

            // d. proceed onward
            elChild = elChild.nextElementSibling;
        }

        // 2. if we’re a border-box, we need to add our own padding
        oStyle = window.getComputedStyle(el);
        if (oStyle.boxSizing === 'border-box')
        {
            iHeight += (oStyle.paddingTop    !== undefined) ? parseInt(oStyle.paddingTop, 10)    : 0;
            iHeight += (oStyle.paddingBottom !== undefined) ? parseInt(oStyle.paddingBottom, 10) : 0;
        }

        // 3. job done
        return iHeight;
    }

    /**
     * Window resize handle: resizes panes to fit content
     */
    function fnResize()
    {
        // 0. zero our height
        var iMaxHeight = 0;

        // 1. first pass: reset the height
        aElPanel.forEach(function(el)
        {
            el.style.height = null;
        });

        // 2. check the current breakpoint
        if (!bp.matchLarger(sBreakpoint))
        {
            return;
        }

        // 3. second pass, get a height
        aElPanel.forEach(function(el)
        {
            // b. work out a proportion
            var iProp = parseInt(el.dataset.equalityPane.trim(), 10);

            // c. acquire the height
            iMaxHeight = Math.max(iMaxHeight, getContentHeight(el) / iProp);
        });

        // 4. third pass: apply it
        aElPanel.forEach(function(el)
        {
            // a. work out a proportion
            var iProp = parseInt(el.dataset.equalityPane.trim(), 10);

            // b. set the height
            el.style.height = (iMaxHeight * iProp)+'px';

        });
    }

    function init()
    {
        // 0. get a trigger point
        sBreakpoint = elRoot.dataset.equality.trim();

        // 1. get panels and default their proportion
        aElPanel = elRoot.querySelectorAll('[data-equality-pane]').toArray();
        aElPanel.forEach(function(el)
        {
            var iTmp = parseInt(el.dataset.equalityPane, 10);
            if (iTmp !== iTmp)
            {
                el.dataset.equalityPane = 1;
            }
        });

        // 2. bind to window resize
        var bBlock = false;
        window.addEventListener('resize', function()
        {
            // 1. if we’re blocked
            if (bBlock)
            {
                return;
            }

            // 2. if not, trigger things
            bBlock = true;
            setTimeout(function()
            {
                // a. reindex and reposition
                fnResize();

                // b. remove the lock
                bBlock = false;

            }, 100);
        });

        // 3. trigger a handler
        fnResize();
    }


    return init();
}

module.exports = function()
{
    "use strict";

    document.querySelectorAll('[data-equality]').each(function(el)
    {
        Equality.call(el);
    });
};
