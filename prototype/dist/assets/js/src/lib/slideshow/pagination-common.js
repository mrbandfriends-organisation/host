module.exports = {
    sequentialPrev: function(iWinStart, iWinSize)
    {
        "use strict";

        return iWinStart - (2 - Math.ceil(iWinSize / 2));
    },
    sequentialNext: function(iWinStart, iWinSize)
    {
        "use strict";

        return iWinStart + Math.ceil(iWinSize / 2);
    },
    toggleClass: function(el, sClass, bAdd)
    {
        "use strict";
        return el.classList[(bAdd ? 'add' : 'remove')](sClass);
    }
};
