/**
 *
 */

var oIconMap = {
    transport: 'black',
    unis:      'orange',
    food:      'grape',
    shopping:  'mint'
};

function GMaps()
{
    "use strict";

    /** ivars */
    var el  = this;
    var oEl = $(this);
    var oMap;
    var aoMarker = {};

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
        else
        {
            oPlace.type = 'default';
        }

        // 5. draw the marker
        var oMarker = new google.maps.Marker(oDefinition);

        // 6. store for later
        if (aoMarker[oPlace.type] === undefined)
        {
            aoMarker[oPlace.type] = [];
        }
        aoMarker[oPlace.type].push(oMarker);
    }

    /**
     * Plot markers
     */
    function plotMarkers()
    {
        // 1. try parsing
        var oMarker = [];
        try
        {
            aoMarker = JSON.parse(el.getAttribute('data-markers'));
        }
        catch (ex)
        {
            return false;
        }

        // 2. iterate through defined markers
        var k;
        for (k in aoMarker)
        {
            // a. *sigh*
            if (!aoMarker.hasOwnProperty(k))
            {
                continue;
            }

            // b. plot
            aoMarker[k].forEach(function(oMarker)
            {
                // i. set type
                oMarker.type = k;

                // ii. plot
                plotPlace(oMarker);
            });

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
        oMap = new google.maps.Map(el, defaults);

        // 3. re-centre, because weirdness
        setTimeout(function()
        {
            oMap.setCenter(defaults.center);
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

        // 6. flag things
        el.classList.add('js-enhanced');
    }

    return init();
}

module.exports = GMaps;
