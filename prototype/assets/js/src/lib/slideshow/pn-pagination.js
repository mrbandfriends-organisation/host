var util = require('slideshow/pagination-common');
var icon = require('svg-icons');

function PnPagination(elParent, aElItems, fnGo)
{
    "use strict";

    var elDom;
    var elPrev;
    var elNext;
    var iWinStart;
    var iWinSize;

    function buildDom()
    {
        // 1. create the main DOM
        elDom = document.createElement('nav');
        elDom.classList.add('slideshow-pagination');
        elDom.classList.add('slideshow-pagination--pn');
        elParent.appendChild(elDom);

        // 2. create a previous button
        elPrev = document.createElement('button');
        elPrev.setAttribute('type', 'button');
        elPrev.classList.add('slideshow-pagination__button');
        elPrev.classList.add('slideshow-pagination__button--prev');
        elPrev.appendChild(icon('arrow-left'));
        elDom.appendChild(elPrev);

        // 3. and a next button
        elNext = document.createElement('button');
        elNext.setAttribute('type', 'button');
        elNext.classList.add('slideshow-pagination__button');
        elNext.classList.add('slideshow-pagination__button--next');
        elNext.appendChild(icon('arrow-left'));
        elDom.appendChild(elNext);

        // 4. bind some events
        elPrev.addEventListener('click', function()
        {
            fnGo(util.sequentialPrev(iWinStart, iWinSize));
            return false;
        });
        elNext.addEventListener('click', function()
        {
            fnGo(util.sequentialNext(iWinStart, iWinSize));
            return false;
        });
    }

    function update(iCurrent, iWindowStart, iWindowSize)
    {
        // 1. update internal pointers
        iWinSize  = iWindowSize;
        iWinStart = iWindowStart;

        // 2. show/hide buttons
        util.toggleClass(elPrev, '-show', (iWindowStart > 0));
        util.toggleClass(elNext, '-show', ((iWindowStart+iWindowSize) < aElItems.length));
    }

    function toggle(bHide)
    {
        util.toggleClass(elDom, '-hidden', bHide);
    }

    return (function()
    {
        // 1. build the DOM
        buildDom();

        // 2. return things
        return {
            update: update,
            toggle: toggle
        };
    })();

}


module.exports = PnPagination;
