// jshint latedef:nofunc
//var cookies         = require('cookies');
var Cookies         = require('js-cookie');
var icon            = require('svg-icons');
var _includes       = require('lodash.includes');



var sFavouriteTemplate =
'<article class="box box--fg-{{availability.foreground}} favourites__favourite" data-id="{{id}}">'+
    '<aside class="favourites__favourite__image"><img src="{{thumbnail}}" alt=""></aside>'+
    '<div class="favourites__favourite__content"><header class="favourites__favourite__header">'+
        '<h3 class="favourites__favourite__title">'+
            '{{city}}<br>{{title}}'+
        '</h3>'+
    '</header>'+
    '<p><strong>Availability:</strong> {{availability.text}}</p>'+
    '<footer class="favourites__favourite__footer">'+
        '<a {{attrs}} href="{{url}}" class="btn btn--small">{{btn_message}}</a>'+
    '</footer></div>'+
'</article>';

function FavouriteList()
{
    "use strict";

    var elDom    = null;
    var elList   = null;
    var elButton = null;
    var aIds     = [];
    var bLoaded  = false;
    var elCount  = null;

    /**
     * Constructor
     */
    function init()
    {
        // 1. build DOM
        buildInitialDom();

        // 2. bind events
        bindEvents();
    }

    /** - Process functions - */
    function loadData()
    {
        // 1. set class
        elDom.classList.add('-loading');
        elList.innerHTML = '';

        // 2. create some data
        var sRequestParms = '?action=buildings_load_favourites&'+aIds.map(function(iD)
        {
            return 'id[]='+iD;
        }).join('&');

        // 3. XHR time
        var oXhr = new XMLHttpRequest();
        oXhr.onreadystatechange = function()
        {
            if (this.readyState === 4)
            {
                fnLoaded(this);
            }
        };

        oXhr.open('get', LOCALISED_VARS.ajaxurl+sRequestParms);
        oXhr.send();

    }

    /** - Event handlers */
    function fnToggleClick()
    {
        // 1. set a flag
        elDom.classList.toggle('-open');
        elButton.classList.toggle('-open');

        // 2. if we’ve not loaded anything
        if (!bLoaded && elDom.classList.contains('-open'))
        {
            loadData();
        }
    }

    /**
     * Called when clicking on a ‘remove’ button.
     */
    function fnRemove(ev)
    {
        // 1. get the ID
        var iBuildingId = parseInt(ev.currentTarget.dataset.id, 10);
        if (iBuildingId !== iBuildingId)
        {
            return false;
        }

        // 2. fire an event
        var oEvt;
        if (window.CustomEvent)
        {
            oEvt = new CustomEvent('remove', { detail: { id: iBuildingId }});
        }
        else
        {
            oEvt = document.createEvent('CustomEvent');
            oEvt.initCustomEvent('remove', true, true, { id: iBuildingId });
        }
        elDom.dispatchEvent(oEvt);

        // 3. remove us from the list
        var elToRemove = elDom.querySelector('[data-id="'+iBuildingId+'"]').parentNode;
        elToRemove.parentNode.removeChild(elToRemove);

        // 4. update the count
        aIds = aIds.filter(function(iCurr) { return (iCurr !== iBuildingId); });
        elCount.innerHTML = '('+aIds.length+')';
    }

    function fnLoaded(oXhr)
    {
        // 0. check for failure
        if (oXhr.status !== 200)
        {
            return;
        }

        // 1. try parsing
        var aoReturn = JSON.parse(oXhr.response);
        if (aoReturn === null)
        {
            return;
        }

        // 2. go through and sort things out
        aoReturn.forEach(function(oFav)
        {
            // a. create LI
            var elLi = document.createElement('li');
            elLi.classList.add('favourites__item');
            elList.appendChild(elLi);

            // b. populate template
            elLi.innerHTML = sFavouriteTemplate.replace(/\{\{(.*?)\}\}/g, function(sM, sField)
            {
                var aField = sField.split('.');
                var ret    = oFav;

                while (aField.length > 0)
                {
                    if (!ret.hasOwnProperty(aField[0]))
                    {
                        return '[ ‘'+sField+'’ not found ]';
                    }
                    ret = ret[aField.shift()];
                }

                return ret;
            });

            // c. throw a button in
            var elButton = document.createElement('button');
            elButton.dataset.id = oFav.id;
            elButton.classList.add('favourites__favourite__remove');
            elButton.classList.add('btn--small');
            elButton.classList.add('btn--ink');
            elButton.innerHTML = 'Remove from favourites';
            elButton.appendChild(icon('cross'));
            elButton.addEventListener('click', fnRemove);

            // d. add it
            elLi.querySelector('.favourites__favourite__footer').appendChild(elButton);
        });

        // 3. update the class
        elDom.classList.remove('-loading');
        bLoaded = true;
    }

    /** - DOM CONSTRUCTION */
    function buildInitialDom()
    {
        // 1. find a parent node
        var elParent = document.querySelector('.js-favouritemanager li:last-child');
        if (elParent === null)
        {
            return false;
        }

        // 2. create new LI
        var elLi = document.createElement('li');
        elLi.classList.add('favourites');
        elParent.parentNode.appendChild(elLi);

        // 3. counter DOM
        elCount = document.createElement('span');
        elCount.classList.add('favourites__count');

        // 4. create our new button
        elButton = document.createElement('button');
        elButton.classList.add('favourites__button');
        elButton.innerHTML = 'My favourites ';
        elButton.appendChild(elCount);
        elButton.appendChild(icon('heart'));
        elLi.appendChild(elButton);

        // 5. create favourite DOM and list
        elDom = document.createElement('aside');
        elDom.classList.add('favourites__flyout');
        elLi.appendChild(elDom);

        elList = document.createElement('ul');
        elList.classList.add('favourites__list');
        elDom.appendChild(elList);

        // 6. empty and loading DOMs
        var elEmpty = document.createElement('p');
        elEmpty.classList.add('favourites__empty');
        elEmpty.classList.add('favourites__message');
        elDom.appendChild(elEmpty);
        elEmpty.innerHTML = 'Start adding buildings to your favourites';

        var elLoading = document.createElement('p');
        elLoading.classList.add('favourites__loading');
        elLoading.classList.add('favourites__message');
        elDom.appendChild(elLoading);
        elLoading.innerHTML = 'Loading…';

        // 7. close button
        var elClose = document.createElement('button');
        elClose.classList.add('favourites__close');
        elClose.appendChild(icon('cross'));
        elDom.appendChild(elClose);
        elClose.addEventListener('click', function(ev)
        {
            elDom.classList.remove('-open');
            elButton.classList.remove('-open');
        });
    }

    function bindEvents()
    {
        // 1. bind on clicking the button
        elButton.addEventListener('click', fnToggleClick);
    }

    /** Constructor logic */
    init();
    return {
        setIds: function(aId)
        {
            // a. set IDs
            aIds = aId;

            // b. mark dirty
            bLoaded = false;

            // c. stuff
            elCount.innerHTML = '('+aId.length+')';

            // d. if we’re already open…
            if (elDom.classList.contains('-open'))
            {
                loadData();
            }
        },
        addEventListener: function(sEvent, fCallback)
        {
            return elDom.addEventListener(sEvent, fCallback);
        }
    };
}

function FavouriteManager()
{
    "use strict";

    var aiFavourites = [];
    var oHeaderDom   = null;

    /** Persistence functions */
    /**
     * Load from the cookie
     */
    function loadFromCookie()
    {
        // 1. read, but default to an empty string
        //var sCookieValue = ""+cookies('favourites') || "";
        

        var sCookieValue = Cookies.get('favourites'); 

        if (sCookieValue !== undefined) {

            // 2. parse out
            aiFavourites = sCookieValue.split(/,\s*/g).map(function(item)
            {
                item = parseInt(item, 10);
                return (item === item) ? item : null;

            }).filter(function(item)
            {
                return (item !== null);
            });
        }
    }

    /**
     * Save to cookie
     */
    function saveToCookie()
    {
        // 1. join
        var sCookieValue = aiFavourites.join(',');

        // 2. store for a year
        Cookies.set('favourites', sCookieValue, {
            expires: 7 * 86400
        });

    }


    function removeCookie()
    {
        Cookies.remove('favourites')
     }

    /**
     * Callback from the header DOM when a ‘remove’ button is pressed
     */
    function fnRemove(ev)
    {
        // 1. get our ID
        var iToRemove = parseInt(ev.detail.id, 10);
        if (iToRemove !== iToRemove)
        {
            return;
        }

        // 2. remove that ID and save
        aiFavourites = aiFavourites.filter(function(iCurr)
        {
            return (iCurr !== iToRemove);
        });

        if (aiFavourites.length) {
            saveToCookie();
        } else {
            removeCookie();
        }

        // 3. find the appropriate element in the list
        document.querySelectorAll('[data-favouritable="'+iToRemove+'"]').each(function(el)
        {
            el.classList.remove('-favourite');
            el.classList.remove('-added');
        });
    }

    /**
     * Adds the favourites button to the header DOM
     */
    function setupHeaderDom()
    {
        // 1. create the object
        oHeaderDom = new FavouriteList();

        // 2. bind an event
        oHeaderDom.addEventListener('remove', fnRemove);

        // 3. update the dom
        oHeaderDom.setIds(aiFavourites);
    }

    /**
     * Sets up “favourite” buttons for all favouritable stuff
     */
    function createFavouritableDom(elFavouritable)
    {
        // 0. get + check ID
        var iId = parseInt(elFavouritable.dataset.favouritable, 10);
        if (iId !== iId)
        {
            return;
        }

        // 1. create a wee container
        var elContainer = document.createElement('aside');
        elContainer.classList.add('favouritable');
        elFavouritable.appendChild(elContainer);

        // 2. button
        var elButton = document.createElement('button');
        elButton.classList.add('favouritable__button');
        elButton.appendChild(icon('heart', 'favouritable__icon'));
        elContainer.appendChild(elButton);

        // 3. boom icon
        elContainer.appendChild(icon('heart', 'favouritable__boom'));

        // 4. mark current
        if (_includes(aiFavourites, iId))
        {
            elFavouritable.classList.add('-favourite');
        }

        // 5. bind to clicking on the button
        elButton.addEventListener('click', function()
        {
            // a. if it contains it, remove
            if ( _includes(aiFavourites, iId) )
            {
                aiFavourites = aiFavourites.filter(function(iCurr)
                {
                    return (iCurr !== iId);
                });
                elFavouritable.classList.remove('-favourite');
                elFavouritable.classList.remove('-added');
            }
            // b. otherwise, add it
            else
            {
                aiFavourites.push(iId);
                elFavouritable.classList.add('-favourite');
                elFavouritable.classList.add('-added');
            }

            // c. poke the DOM
            oHeaderDom.setIds(aiFavourites);

            // d. save
            saveToCookie(aiFavourites);
            return false;
        });

        // 6. add a class
        elFavouritable.classList.add('favouritable__container');
    }

    function init()
    {


        // 0. load from the cookie
        loadFromCookie();

        // 1. set up header DOM
        setupHeaderDom();

        // 2. bind favouritable stuff
        document.querySelectorAll('[data-favouritable]').each(createFavouritableDom);
    }

    /**
     * Init function
     */
    return init();
}

module.exports = (function()
{
    "use strict";

    new FavouriteManager();
})();
