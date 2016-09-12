/**
 *
 */

var oIconMap = {
    transport: 'black',
    unis:      'orange',
    food:      'grape',
    shops:     'mint'
};

function GMaps()
{
    "use strict";

    /** ivars */
    var el  = this;
    var oMap;
    var aoMarker = {};
    var aoFilter = [];
    var oWin     = null;
    var oBounds  = null;

    // config
    var defaults = {
        zoom:               15,
        center:             { lat: 0, lng: 0 },
        mapTypeControl:     false,
        streetViewControl:  false
    };

    /** Function definitions */
    /**
     * Load configuration
     */
    function getConfig()
    {
        // 1. get a centre point
        var sCentre = el.getAttribute('data-centre');
        var aM, fLat, fLong;

        // a. duck type
        if ((sCentre === null) || ((aM = sCentre.match(/^(\-?[\d\.]+),(\-?[\d\.]+)$/)) === null))
        {
            return false;
        }

        // b. slightly better check
        fLat  = parseFloat(aM[1]);
        fLong = parseFloat(aM[2]);
        if ((fLat !== fLat) || (fLong !== fLong))
        {
            return false;
        }

        // c. set
        defaults.center = { lat: fLat, lng: fLong };

        // 2. how about a zoom
        var iZoom = (el.hasAttribute('data-zoom')) ? parseInt(el.getAttribute('data-zoom'), 10) : defaults.zoom;
        if (iZoom === iZoom)
        {
            defaults.zoom = iZoom;
        }

        return true;
    }

    /**
     * Shows an info window
     */
    function showInfoWindow()
    {
        /* jshint validthis: true */
        // 1. if there’s no window
        if (oWin === null)
        {
            oWin = new google.maps.InfoWindow({ content: "" });
        }

        // 2. set the content + show it
        oWin.setContent('<strong class="map__info-window">'+this.title+'</strong>');
        oWin.open(oMap, this);
    }

    /**
     * Plots the main (place) marker on a map
     */
    function plotPlace(place)
    {
        // 1. get and check
        if ((place.replace !== undefined) && (place.replace(/\s/g, '') === ''))
        {
            return false;
        }

        // 2. get some information!
        var oPlace = place;
        if (typeof oPlace === "string")
        {
            try
            {
                oPlace = JSON.parse(place);
            }
            catch (ex)
            {
                oPlace = {
                    title: place,
                    lat:   defaults.center.lat,
                    lng:   defaults.center.lng
                };
            }
        }

        // 3. convert to a marker definition
        var oDefinition = {
            map:      oMap,
            position: { lat: oPlace.lat, lng: oPlace.lng },
            title:    oPlace.title
        };

        // 4. if we have a type
        if ((oPlace.type !== undefined) && (oIconMap[oPlace.type] !== undefined))
        {
            oDefinition.icon = WEB_ROOT+'assets/svg/standalone/output/marker-'+oIconMap[oPlace.type]+'.svg';
        }

        // 5. draw the marker and place it in bounds
        var oMarker = new google.maps.Marker(oDefinition);
        oBounds.extend(oMarker.position);

        // 7. if it’s a default marker, bail
        if (oPlace.type === undefined)
        {
            return true;
        }

        // 8. otherwise, store it for later
        if (aoMarker[oPlace.type] === undefined)
        {
            aoMarker[oPlace.type] = [];
        }
        aoMarker[oPlace.type].push(oMarker);

        // 9. bind click…
        oMarker.addListener('click', showInfoWindow);
    }

    /**
     * Plot markers
     */
    function plotMarkers()
    {
        // 1. try parsing
        var aoMark = [];
        try
        {
            aoMark = JSON.parse(el.getAttribute('data-markers'));
        }
        catch (ex)
        {
            return false;
        }

        // 2. iterate through defined markers
        var k;
        for (k in aoMark)
        {
            // a. *sigh*
            if (!aoMark.hasOwnProperty(k))
            {
                continue;
            }

            // b. plot
            /* jshint loopfunc:true */
            aoMark[k].forEach(function(oMarker)
            {
                // i. set type
                oMarker.type = k;

                // ii. plot
                plotPlace(oMarker);
            });
        }
    }

    /**
     * Updates filters
     */
    function updateFilters()
    {
        // 1. iterate our way through the filters and toggle markers
        aoFilter.forEach(function(elFilter)
        {
            // a. set some stuff
            var sFilter = elFilter.value;
            var bCheck  = elFilter.checked;

            // a. do we have any markers of that type?
            if (aoMarker[sFilter] === undefined)
            {
                return;
            }

            // b. if so, wander through and update their visibility
            aoMarker[sFilter].forEach(function(oF)
            {
                oF.setVisible(bCheck);
            });
        });

        // 2. hide the info window, just to make things easier
        if (oWin !== null)
        {
            oWin.close();
        }
    }

    /**
     * Constructor Logic
     */
    function init()
    {
        // 1. get configuration
        if (!getConfig())
        {
            return false;
        }

        // 2. draw map
        oMap    = new google.maps.Map(el, defaults);
        oBounds = new google.maps.LatLngBounds();

        // 3. re-centre, because weirdness
        setTimeout(function()
        {
            oMap.fitBounds(oBounds);
        }, 1000);

        // 4. if we have a place, point at it
        if (el.hasAttribute('data-place'))
        {
            plotPlace(el.getAttribute('data-place'));
        }

        // 5. if there are markers
        if (el.hasAttribute('data-markers'))
        {
            plotMarkers();
        }

        // 6. passively hook filters
        aoFilter = el.parentNode.querySelectorAll('input[type=checkbox]').toArray();
        aoFilter.forEach(function(el)
        {
            el.addEventListener('change', updateFilters);
        });

        // 7. flag things and recentre on bounds
        el.classList.add('js-enhanced');
    }

    return init();
}

module.exports = GMaps;
