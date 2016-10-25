/**
 *
 */
var GMaps        = require('google-maps');
var maps_loading = false;
var maps_loaded  = false;

module.exports = function()
{
    "use strict";

    /**
     * Callback
     */
    function hasLoaded()
    {
        // set flags
        maps_loading = false;
        maps_loaded  = true;

        document.querySelectorAll('.js-map').toArray().forEach(function(el)
        {
            GMaps.call(el);
        });
    }

    // determine load state
    if (!maps_loaded && !maps_loading)
    {
        maps_loading = true;
        require('fg-loadjs')('//maps.googleapis.com/maps/api/js?v=3.exp&key='+LOCALISED_VARS.google_maps_key, hasLoaded);
    }
    else if (maps_loaded)
    {
        hasLoaded();
    }


};
