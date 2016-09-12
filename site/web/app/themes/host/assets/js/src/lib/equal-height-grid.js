/**
 * EQUAL HEIGHT GRID
 *
 * Ensures equal heights across all breakpoints.
 */

function EqualHeightGrid()
{
    var elGrid = this;
    var aElBlocks;
    var bBlocked;
    return init();

    function init()
    {
        // 1. acquire blocks
        acquireContentBlocks();

        // 3. bind to resize event
        window.addEventListener('resize', function()
        {
            // a. blocking
            if (bBlocked)
                return;
            bBlocked = true;

            // b. timeout
            setTimeout(fnResize, 100);
        });
        $(elGrid).on('contentLoaded', function()
        {
            // a. reacquire content blocks
            acquireContentBlocks();

            // b. trigger the resize handler
            bBlocked = true;
            fnResize();
        });

        // 4. trigger
        bBlocked = true;
        fnResize();
    }

    function acquireContentBlocks()
    {
        // 1. look up children (+ cast to array);
        aElBlocks = Array.prototype.slice.call(elGrid.querySelectorAll('[data-grid-post]'));

        // 2. add references for later
        aElBlocks.forEach(function(el)
        {
            // a. max height
            el.elMax = el.querySelector('[data-grid-maximise]');

            // b. class
            if (el.className.indexOf('-js-enabled') === -1)
                el.className += ' -js-enabled';
        });
    }

    function fnResize()
    {
        // 0. hooks
        var iCurrMax = 0;

        // 1. go through each block, reset the maximised height
        aElBlocks.forEach(function(el)
        {
            el.elMax.style.height = '';
        });

        // 2. get new heights
        var iCurrY = 0;
        var iRow   = -1;
        aElBlocks.forEach(function(el)
        {
            // a. update current maximum
            iCurrMax = Math.max(iCurrMax, el.scrollHeight);

            // b. if we’re on a different line, increment pointers
            if (iCurrY != el.parentNode.offsetTop)
            {
                iRow++;
                iCurrY = el.parentNode.offsetTop;
            }

            // c. store line
            el.row = iRow;
        });

        // 3. set the new height
        aElBlocks.forEach(function(el)
        {
            // a. if we’re double-high
            //    Note: replace is because IE reports an empty pseudo as having content ‘none’, which is useful… ಠ_ಠ
            if ((window.getComputedStyle(el, ':before').content.replace('none', '') !== "") && (el.row < iRow))
                el.elMax.style.height = (iCurrMax * 2)+'px';
            // b. otherwise, just set the height
            else
                el.elMax.style.height = iCurrMax+'px';

        });

        // 4. unblock
        bBlocked = false;
    }
}

module.exports = (function()
{
    Array.prototype.slice.call(document.querySelectorAll('[data-grid]')).forEach(function(el)
    {
        EqualHeightGrid.call(el);
    });
});
