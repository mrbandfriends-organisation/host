/* jshint strict: false */
/**
 * OFFCANVAS TOGGLER
 * manages toggling of offcanvas elements
 */

var EventBus = require('pubsub-js');

var OffCanvasToggler = function(options) {
    "use strict";


    // Defaults
    var defaults = {
        wrapper: '.js-offcanvas__wrapper',
        menu: '.js-primary-offcanvas',
        toggleElements: '.js-offcanvas-toggle',
        activeLeftClass: 'is-active-left',
        activeRightClass: 'is-active-right'
    };

    this.settings = $.extend( {}, defaults, options );

    this.$root              = $(':root');
    this.$menu              = $(this.settings.menu);
    this.$wrapper           = $(this.settings.wrapper);
    this.$toggleElements    = $(this.settings.toggleElements);

    this.state              = 'closed';

    this._init();
};

/**
 * Init
 * kicks things off...
 */
OffCanvasToggler.prototype._init = function() {
    "use strict";

    this._addListeners();
};


/**
 * Add Listners
 * handles attaching of event listeners
 */
OffCanvasToggler.prototype._addListeners = function() {
    "use strict";

    //
    this.$root.on('click', this.settings.toggleElements, this._handleToggle.bind(this) );

    EventBus.subscribe('offcanvasToggle', function(eventMsg, eventData) {
        this._updateDisplay(eventData.command);
    }.bind(this));
};

/**
 * Handle Toggle
 * evaluates current offcanvas state and delegates to
 * handler methods to open/close as required
 */
OffCanvasToggler.prototype._handleToggle = function(event) {
    "use strict";


    if (this.state === 'closed') {
        this.open();
    } else if (this.state === 'open') {
        this.close();
    }
};


/**
 * Toggle
 * utility function to set 'state' and publish events
 * relating to toggling of offcanvas
 */
OffCanvasToggler.prototype._toggle = function(command) {
    "use strict";



    EventBus.publish('offcanvasToggle', {
        command: command
    });

    this.state = (command === 'open') ? 'open' : 'closed';
};


/**
 * Update Display
 * manages show and hiding of offcanvas via add/remove
 * of trigger className to wrapper element
 */
OffCanvasToggler.prototype._updateDisplay = function(command) {
    "use strict";

    if (command === 'open') {
        this.$wrapper.addClass( this.settings.activeRightClass );
        this.$menu.setAttribute('aria-hidden', 'false');
        this.$toggleElements.setAttribute('aria-expanded');
    } else if (command === 'close') {
        this.$wrapper.removeClass( this.settings.activeRightClass );
        this.$menu.setAttribute('aria-hidden', 'true');
        this.$toggleElements.removeAttribute('aria-expanded');
    }
};


/**
 * Open
 * triggers opening of offcanvas
 */
OffCanvasToggler.prototype.open = function() {
    "use strict";

    this._toggle('open');
};


/**
 * Close
 * triggers close of offcanvas
 */
OffCanvasToggler.prototype.close = function() {
    "use strict";

    this._toggle('close');
};

// Export
module.exports = OffCanvasToggler;
