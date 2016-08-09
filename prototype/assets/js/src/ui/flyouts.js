/**
 *
 */
var createIcon = require('svg-icons');

function Flyout()
{
    "use strict";

    var el = this;
    var elButton;

    function handleClick()
    {
        el.classList.toggle('js-flyout--open');
        return false;
    }

    /**
     * Constructor
     */
    return (function()
    {
        // 1. insert a button
        elButton = document.createElement('button');
        elButton.setAttribute('type', 'button');
        elButton.classList.add('btn', 'js-flyout__button');
        el.appendChild(elButton);

        // 2. insert the icon
        elButton.appendChild(createIcon('arrow-left'));

        // 3. bind click
        elButton.addEventListener('click', handleClick);

        // 4. add an active class
        el.classList.add('js-flyout--active');
    })();
}

module.exports = function()
{
    "use strict";

    document.querySelectorAll('.js-flyout').each(function(el)
    {
        Flyout.call(el);
    });
};
