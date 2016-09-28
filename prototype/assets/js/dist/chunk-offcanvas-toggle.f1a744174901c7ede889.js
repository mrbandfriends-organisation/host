webpackJsonp([1],{

/***/ 9:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {/* jshint strict: false */
	/**
	 * OFFCANVAS TOGGLER
	 * manages toggling of offcanvas elements
	 */

	var EventBus = __webpack_require__(44);

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

	    debugger;

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

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(5)))

/***/ },

/***/ 44:
/***/ function(module, exports, __webpack_require__) {

	var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/*
	Copyright (c) 2010,2011,2012,2013,2014 Morgan Roderick http://roderick.dk
	License: MIT - http://mrgnrdrck.mit-license.org

	https://github.com/mroderick/PubSubJS
	*/
	(function (root, factory){
		'use strict';

	    if (true){
	        // AMD. Register as an anonymous module.
	        !(__WEBPACK_AMD_DEFINE_ARRAY__ = [exports], __WEBPACK_AMD_DEFINE_FACTORY__ = (factory), __WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ? (__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__), __WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));

	    } else if (typeof exports === 'object'){
	        // CommonJS
	        factory(exports);

	    }

	    // Browser globals
	    var PubSub = {};
	    root.PubSub = PubSub;
	    factory(PubSub);
	    
	}(( typeof window === 'object' && window ) || this, function (PubSub){
		'use strict';

		var messages = {},
			lastUid = -1;

		function hasKeys(obj){
			var key;

			for (key in obj){
				if ( obj.hasOwnProperty(key) ){
					return true;
				}
			}
			return false;
		}

		/**
		 *	Returns a function that throws the passed exception, for use as argument for setTimeout
		 *	@param { Object } ex An Error object
		 */
		function throwException( ex ){
			return function reThrowException(){
				throw ex;
			};
		}

		function callSubscriberWithDelayedExceptions( subscriber, message, data ){
			try {
				subscriber( message, data );
			} catch( ex ){
				setTimeout( throwException( ex ), 0);
			}
		}

		function callSubscriberWithImmediateExceptions( subscriber, message, data ){
			subscriber( message, data );
		}

		function deliverMessage( originalMessage, matchedMessage, data, immediateExceptions ){
			var subscribers = messages[matchedMessage],
				callSubscriber = immediateExceptions ? callSubscriberWithImmediateExceptions : callSubscriberWithDelayedExceptions,
				s;

			if ( !messages.hasOwnProperty( matchedMessage ) ) {
				return;
			}

			for (s in subscribers){
				if ( subscribers.hasOwnProperty(s)){
					callSubscriber( subscribers[s], originalMessage, data );
				}
			}
		}

		function createDeliveryFunction( message, data, immediateExceptions ){
			return function deliverNamespaced(){
				var topic = String( message ),
					position = topic.lastIndexOf( '.' );

				// deliver the message as it is now
				deliverMessage(message, message, data, immediateExceptions);

				// trim the hierarchy and deliver message to each level
				while( position !== -1 ){
					topic = topic.substr( 0, position );
					position = topic.lastIndexOf('.');
					deliverMessage( message, topic, data, immediateExceptions );
				}
			};
		}

		function messageHasSubscribers( message ){
			var topic = String( message ),
				found = Boolean(messages.hasOwnProperty( topic ) && hasKeys(messages[topic])),
				position = topic.lastIndexOf( '.' );

			while ( !found && position !== -1 ){
				topic = topic.substr( 0, position );
				position = topic.lastIndexOf( '.' );
				found = Boolean(messages.hasOwnProperty( topic ) && hasKeys(messages[topic]));
			}

			return found;
		}

		function publish( message, data, sync, immediateExceptions ){
			var deliver = createDeliveryFunction( message, data, immediateExceptions ),
				hasSubscribers = messageHasSubscribers( message );

			if ( !hasSubscribers ){
				return false;
			}

			if ( sync === true ){
				deliver();
			} else {
				setTimeout( deliver, 0 );
			}
			return true;
		}

		/**
		 *	PubSub.publish( message[, data] ) -> Boolean
		 *	- message (String): The message to publish
		 *	- data: The data to pass to subscribers
		 *	Publishes the the message, passing the data to it's subscribers
		**/
		PubSub.publish = function( message, data ){
			return publish( message, data, false, PubSub.immediateExceptions );
		};

		/**
		 *	PubSub.publishSync( message[, data] ) -> Boolean
		 *	- message (String): The message to publish
		 *	- data: The data to pass to subscribers
		 *	Publishes the the message synchronously, passing the data to it's subscribers
		**/
		PubSub.publishSync = function( message, data ){
			return publish( message, data, true, PubSub.immediateExceptions );
		};

		/**
		 *	PubSub.subscribe( message, func ) -> String
		 *	- message (String): The message to subscribe to
		 *	- func (Function): The function to call when a new message is published
		 *	Subscribes the passed function to the passed message. Every returned token is unique and should be stored if
		 *	you need to unsubscribe
		**/
		PubSub.subscribe = function( message, func ){
			if ( typeof func !== 'function'){
				return false;
			}

			// message is not registered yet
			if ( !messages.hasOwnProperty( message ) ){
				messages[message] = {};
			}

			// forcing token as String, to allow for future expansions without breaking usage
			// and allow for easy use as key names for the 'messages' object
			var token = 'uid_' + String(++lastUid);
			messages[message][token] = func;

			// return token for unsubscribing
			return token;
		};

		/* Public: Clears all subscriptions
		 */
		PubSub.clearAllSubscriptions = function clearAllSubscriptions(){
			messages = {};
		};

		/*Public: Clear subscriptions by the topic
		*/
		PubSub.clearSubscriptions = function clearSubscriptions(topic){
			var m; 
			for (m in messages){
				if (messages.hasOwnProperty(m) && m.indexOf(topic) === 0){
					delete messages[m];
				}
			}
		};

		/* Public: removes subscriptions.
		 * When passed a token, removes a specific subscription.
		 * When passed a function, removes all subscriptions for that function
		 * When passed a topic, removes all subscriptions for that topic (hierarchy)
		 *
		 * value - A token, function or topic to unsubscribe.
		 *
		 * Examples
		 *
		 *		// Example 1 - unsubscribing with a token
		 *		var token = PubSub.subscribe('mytopic', myFunc);
		 *		PubSub.unsubscribe(token);
		 *
		 *		// Example 2 - unsubscribing with a function
		 *		PubSub.unsubscribe(myFunc);
		 *
		 *		// Example 3 - unsubscribing a topic
		 *		PubSub.unsubscribe('mytopic');
		 */
		PubSub.unsubscribe = function(value){
			var isTopic    = typeof value === 'string' && messages.hasOwnProperty(value),
				isToken    = !isTopic && typeof value === 'string',
				isFunction = typeof value === 'function',
				result = false,
				m, message, t;

			if (isTopic){
				delete messages[value];
				return;
			}

			for ( m in messages ){
				if ( messages.hasOwnProperty( m ) ){
					message = messages[m];

					if ( isToken && message[value] ){
						delete message[value];
						result = value;
						// tokens are unique, so we can just stop here
						break;
					}

					if (isFunction) {
						for ( t in message ){
							if (message.hasOwnProperty(t) && message[t] === value){
								delete message[t];
								result = true;
							}
						}
					}
				}
			}

			return result;
		};
	}));


/***/ }

});