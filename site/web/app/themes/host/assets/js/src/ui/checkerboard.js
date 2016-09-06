// jshint latedef:nofunc
/**
 * Checkerboard UI code.
 */
function Checkerboard()
{
    "use strict";

    // ivars
    var oEl        = $(this);
    var aoChildren = oEl.find('.js-checkerboard__item');

    if (aoChildren.length > 0)
    {
        init();
    }
    return true;

    /**
     * Constructor-esque logic
     */
    function init()
    {
        // 1. bind to clicking on trigger elements
        oEl.on('click', '.js-checkerboard__trigger', fnHandleClick);
    }

    /**
     * Click handler
     */
    function fnHandleClick(event)
    {
        // 1. get the victim
        var oVictim = $(this).parents('.js-checkerboard__item'); // jshint ignore:line

        // 2. if it’s closed, make sure all other children are closed
        if (!oVictim.hasClass('-active'))
        {
            aoChildren.removeClass('-active');

        }

        // 3. toggle class
        oVictim.toggleClass('-active');

        event.preventDefault();
        event.stopPropagation();

        return false;
    }
}

module.exports = (function()
{
    "use strict";

    document.querySelectorAll('.js-checkerboard').toArray().forEach(function(el)
    {
        Checkerboard.call(el);
    });
})();
