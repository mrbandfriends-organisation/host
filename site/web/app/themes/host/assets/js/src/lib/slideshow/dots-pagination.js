var util = require('slideshow/pagination-common');
var icon = require('svg-icons');

function DotsPagination(oApi)
{
    "use strict";

    var elDom;
    var aElPages = [];

    function fnClick(ev)
    {
        oApi.fnGo(parseInt(ev.currentTarget.dataset.id));
        return false;
    }

    function buildDom()
    {
        // 1. create the main DOM
        elDom = document.createElement('nav');
        elDom.classList.add('slideshow-pagination');
        elDom.classList.add('slideshow-pagination--dots');
        oApi.elRoot.appendChild(elDom);

        // 2. create list
        var elList = document.createElement('ol');
        elList.classList.add('slideshow-pagination__list');
        elDom.appendChild(elList);

        // 3. start creating nodes
        for (var i = 0; i < oApi.iNumItems; i++)
        {
            // a. LI
            var elLi = document.createElement('li');
            elLi.classList.add('slideshow-pagination__item');
            elList.appendChild(elLi);

            // b. button
            var elButton = document.createElement('button');
            elButton.setAttribute('type', 'button');
            elButton.dataset.id = i;
            elButton.classList.add('slideshow-pagination__page');
            elLi.appendChild(elButton);

            // c. event handler
            elButton.addEventListener('click', fnClick);

            // d. push
            aElPages.push(elButton);
        }
    }

    function update(iCurrent, iWindowStart, iWindowSize)
    {
        // 1. reset things
        aElPages.forEach(function(el)
        {
            el.classList.remove('-current');
            el.classList.remove('-window');
        });

        // 2. set the current page
        aElPages[iCurrent].classList.add('-current');

        // 3. window!
        for (var i = iWindowStart; i < (iWindowStart + iWindowSize); i++)
        {
            aElPages[i].classList.add('-window');
        }
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


module.exports = DotsPagination;
