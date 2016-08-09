
module.exports = function(sIcon)
{
    "use strict";

    // 0. default class
    var sClass = (arguments.length === 2) ? ' '+arguments[1] : '';

    // 1. create our SVG element
    var sNs   = 'http://www.w3.org/2000/svg';
	var elSvg = document.createElementNS(sNs, 'svg');
	elSvg.setAttributeNS(null, 'class', 'svg-icon'+sClass);
	elSvg.setAttributeNS(null, 'aria-hidden', 'true');

    // 2. add the USE element
    var elUse = document.createElementNS(sNs, 'use');
    elUse.setAttributeNS('http://www.w3.org/1999/xlink', 'xlink:href', '#icon-'+sIcon);
    elSvg.appendChild(elUse);

    return elSvg;
};
