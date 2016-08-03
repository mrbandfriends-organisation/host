/* jshint strict:false */
/**
 * GOOGLE EVENT TRACKING
 * reusable method to allow GA Events to be defined using
 * data attributes in the DOM
 */

var GATracker = function(selector) {
    this.$root = $('body');
    this.selector = selector;

    this.init();
};

GATracker.prototype.init = function() {
    this._addListeners();
};

GATracker.prototype._addListeners = function() {
    var self = this;
    var selector = this.selector;

    this.$root.on('click change', selector, function(event) {
        self._handleTracking($(this),event);
    });
};

GATracker.prototype.trackEvent = function(data, event) {
    //debugger;
    if ( !(ga && data.eventCategory && data.eventAction && data.eventLabel) ) {
        return false;
    }


    var el = event.srcElement || event.target;

    /* Loop up the DOM tree through parent elements if clicked element is not a link (eg: an image inside a link) */
    while (el && (typeof el.tagName == 'undefined' || el.tagName.toLowerCase() != 'a' || !el.href)) { // jshint ignore:line
        el = el.parentNode;
    }

    /* if a link has been clicked */
    if (el && el.href) {

        var link = el.href;



            var hbrun = false; // tracker has not yet run

            /* HitCallback to open link in same window after tracker */
            var hitBack = function() {
                /* run once only */
                if (hbrun) return; // jshint ignore:line
                hbrun = true;
                window.location.href = link;
            };


            /* send event with callback */

            ga("send", "event", {
                eventCategory: data.eventCategory,
                eventAction: data.eventAction,
                eventLabel: data.eventLabel,
                "hitCallback": hitBack
            });

            /* Run hitCallback if GA takes too long */
            setTimeout(hitBack, 1000);

            /* Prevent standard click */
            event.preventDefault ? event.preventDefault() : event.returnValue = !1; // jshint ignore:line



    }

};



GATracker.prototype._handleTracking = function($el,event) {
    var data = this._getData($el);

    if (!data.eventValue) {

        if ($el.is('select')) {
            data.eventValue = $el.children('option:selected').val();
        } else {
            data.eventValue = $el.html();
        }
    }

    this.trackEvent(data,event);
};


GATracker.prototype._getData = function($el) {
    var eventCategory = $el.data('ga-category') || false;
    var eventAction = $el.data('ga-action') || false;
    var eventLabel = $el.data('ga-label') || false;
    var eventValue = $el.data('ga-value') || false;

    return {
        eventCategory: eventCategory,
        eventAction: eventAction,
        eventLabel: eventLabel,
        eventValue: eventValue
    };
};

// Export
module.exports = GATracker;
