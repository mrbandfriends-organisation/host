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

        [].slice.call(document.querySelectorAll('.js-map')).forEach(function(el)
        {
            GMaps.call(el);
        });
    }

    // determine load state
    if (!maps_loaded && !maps_loading)
    {
        maps_loading = true;
        require('fg-loadjs')('//maps.googleapis.com/maps/api/js?v=3.exp&key='+GOOGLE_MAPS_KEY, hasLoaded);
    }
    else if (maps_loaded)
    {
        hasLoaded();
    }


};
