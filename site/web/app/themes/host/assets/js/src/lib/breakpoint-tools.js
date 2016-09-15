var aBreakpoint = require('../breakpoints');

/**
 * Returns the current breakpoint
 */
function getCurrentBreakpoint()
{
    "use strict";

    return window.getComputedStyle(document.body, ':before').content.replace(/[^a-z]/g, '');
}

/**
 * Returns true if the current browser state matches the given viewport
 */
function matchesCurrentBreakpoint(sBreakpoint)
{
    "use strict";

    return (sBreakpoint === getCurrentBreakpoint());
}

/**
 * Returns true if the browser window is larger than the given viewport.
 */
function largerThanBreakpoint(sBreakpoint)
{
    // 1. cast current and required breakpoints
    var iCurr = aBreakpoint.indexOf(getCurrentBreakpoint());
    var iTest = aBreakpoint.indexOf(sBreakpoint);

    // 2. return
    return (iCurr >= iTest);
}

/**
 * Returns true if the browser window is smaller than the given viewport.
 */
function smallerThanBreakpoint(sBreakpoint)
{
    // 1. cast current and required breakpoints
    var iCurr = aBreakpoint.indexOf(getCurrentBreakpoint());
    var iTest = aBreakpoint.indexOf(sBreakpoint);

    // 2. return
    return (iCurr <= iTest);
}

module.exports = {
    breakpoints:  aBreakpoint,
    current:      getCurrentBreakpoint,
    match:        matchesCurrentBreakpoint,
    matchLarger:  largerThanBreakpoint,
    matchSmaller: smallerThanBreakpoint
};
