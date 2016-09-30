// jshint latedef:nofunc
/**
 * Checkerboard UI code.
 */
function Checkerboard()
{
    "use strict";

    // ivars
    var elRoot    = this;
    var aElChild  = this.querySelectorAll('.js-checkerboard__item').toArray();
    var aRow      = [];
    var bMobBuilt = false;

    /**
     *
     */
    function buildMobileVersion()
    {
        // 0. get a reference marker
        var elMarker = elRoot.querySelector('.js-checkerboard__sell');
        if (elMarker === null)
        {
            bMobBuilt = true;
            return false;
        }

        // 1. build containing LI
        var elMobileDom = document.createElement('li');
        elMobileDom.classList.add('checkerboard__mobile');
        elMobileDom.classList.add('gc');
        elMarker.parentNode.insertBefore(elMobileDom, elMarker);

        // 2. build label for select box
        var elLabel = document.createElement('label');
        elLabel.for = 'checkerboard_mobile_selector';
        elLabel.innerHTML = 'Select city';
        elLabel.classList.add('vh');
        elMobileDom.appendChild(elLabel);

        // 3. select box
        var elSelect = document.createElement('select');
        elSelect.id = 'checkerboard_mobile_selector';
        elSelect.classList.add('checkboard__mobile-selector');
        elMobileDom.appendChild(elSelect);
        elSelect.innerHTML = '<option>Select a city</option>';

        // 4. populate
        elRoot.querySelectorAll('.js-checkerboard__trigger').each(function(el)
        {
            var elOpt = document.createElement('option');
            elOpt.value = el.getAttribute('href');
            elOpt.innerHTML = el.innerHTML;

            elSelect.appendChild(elOpt);
        });

        // 5. bind to change
        elSelect.addEventListener('change', function()
        {
            if (elSelect.selectedIndex > 0)
            {
                document.location.href = elSelect.options[elSelect.selectedIndex].value;
                return false;
            }
            return true;
        });

        // 6. set a flag
        bMobBuilt = true;

    }

    /**
     * Reindexes the position of everything in the grid
     */
    function reindex()
    {
        // 0. refs
        var iLastTop = -1;
        var iRowPtr  = -1;

        // 1. zero everything
        aRow = [];

        // 2. go through all kids
        aElChild.forEach(function(el)
        {
            // a. get the offset
            var iOff = el.offsetTop;

            // b. if that’s not the current one
            if (iLastTop !== iOff)
            {
                // increment pointer and create new row
                aRow.push([]);
                iRowPtr++;

                // store last top
                iLastTop = iOff;
            }

            // c. add it
            aRow[iRowPtr].push(el);
        });
    }

    /**
     * Repositions items in the grid
     */
    function reposition()
    {
        // 1. find the current changed item for later
        var elChangedItem = elRoot.querySelector('.js-checkerboard__item.-active');
        var iWidth        = (elChangedItem !== null) ? elChangedItem.querySelector('.js-checkerboard__content').scrollWidth : 0;

        // 2. iterate through our rows
        aRow.forEach(function(aEl)
        {
            // a. zero things
            var fLeft   = 0;
            var fRight  = 0;

            // b. look for things
            var iChangedIdx = aEl.indexOf(elChangedItem);

            // c. if it’s in this row
            if (iChangedIdx !== -1)
            {
                // set offsets
                fLeft  = iWidth * (iChangedIdx / (aEl.length - 1));
                fRight = iWidth - fLeft;
            }

            // d. set things
            aEl.forEach(function(el, iCurrIdx)
            {
                el.style.transform = 'translateX('+(iCurrIdx <= iChangedIdx ? 0 - fLeft : fRight)+'px)';
            });
        });

        return true;
    }

    /**
     * Handles clicking on an item
     */
    function fnClick(ev)
    {
        // 1. stop normal stuff
        ev.stopPropagation();
        ev.preventDefault();

        // 2. get the item it belongs to
        var elItem = ev.currentTarget;
        while ((elItem !== null) && !elItem.classList.contains('js-checkerboard__item'))
        {
            elItem = elItem.parentNode;
        }

        // 3. get any possible offender
        var elOffender = elRoot.querySelector('.js-checkerboard__item.-active');
        if ((elOffender !== null) && (elOffender !== elItem))
        {
            elOffender.classList.remove('-active');
        }

        // 4. and add our new classes
        elItem.classList.toggle('-active');

        // 5. recalculate position
        reposition();

        return false;
    }

    function fnResize()
    {
        // 1. if there’s nothing to look at
        if ((aElChild[0].scrollWidth === 0) && !bMobBuilt)
        {
            buildMobileVersion();
        } else {
            console.log("scrollWidth = " + aElChild[0].scrollWidth);
            console.log(bMobBuilt);
        }

        // 2. reindex and reposition
        reindex();
        reposition();
    }

    /**
     * Constructor-esque logic
     */
    function init()
    {
        // 0. short-circuit
        if (aElChild.length === 0)
        {
            return false;
        }

        // 1. bind to triggers
        elRoot.querySelectorAll('.js-checkerboard__trigger').each(function(el)
        {
            el.addEventListener('click', fnClick);
        });

        // 2. bind to resize on the window
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
                fnResize();
                bBlock = false;
            }, 10);
        });

        // 3. reindex everything
        fnResize();

    }

    /** Initer */
    return init();
}

module.exports = (function()
{
    "use strict";

    document.querySelectorAll('.js-checkerboard').toArray().forEach(function(el)
    {
        Checkerboard.call(el);
    });
})();
