var util = require('slideshow/pagination-common');
var icon = require('svg-icons');

function DotsPagination(elParent, aElItems, fnGo)
{
    "use strict";

    var elDom;
    var aElPages = [];

    function buildDom()
    {
        // 1. create the main DOM
        elDom = document.createElement('nav');
        elDom.classList.add('slideshow-pagination');
        elDom.classList.add('slideshow-pagination--dots');
        elParent.appendChild(elDom);

        // 2. create list
        var elList = document.createElement('ol');
        elList.classList.add('slideshow-pagination__list');
        elDom.appendChild(elList);

        // 3. start creating nodes
        aElItems.forEach(function(el, idx)
        {
            // a. LI
            var elLi = document.createElement('li');
            elLi.classList.add('slideshow-pagination__item');
            elList.appendChild(elLi);

            // b. button
            var elButton = document.createElement('button');
            elButton.setAttribute('type', 'button');
            elButton.classList.add('slideshow-pagination__page');
            elLi.appendChild(elButton);

            // c. event handler
            elButton.addEventListener('click', function()
            {
                fnGo(idx);
                return false;
            });

            // d. push
            aElPages.push(elButton);
        });
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
