webpackJsonp([0,3],{

/***/ 7:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {"use strict";

	var salvattore = __webpack_require__(10);
	/**
	 * POSTS LOADER
	 *
	 * a utility "class" the wraps the process of "lazy" loading Blog posts
	 * over Ajax.
	*/

	var PostsLoader = function(options) {


	    var defaults = {
	        'dataEndpoint'          : false,
	        'paginationUrl'         : '/news/', // url format for pagination (eg: /blog/page/1/)
	        'triggerEl'             : '.js-posts-loader-trigger', // element which initialising loading of new posts
	        'containerEl'           : '.js-posts-loader-container', // element into which new posts should be inserted
	        'loadingErrorMsg'       : '<p>Unfortunately, there was an error loading the additional posts. Please try again.</p>',
	        'updateHistory'         : true, // whether or not to update the browser history on each page reload
	        'triggerActiveClass'    : '-loading',
	        'postsPerPage'          : 6,
	        'postType'              : 'post',
	        'order'                 : 'ASC',
	        'orderBy'               : 'date'
	    };

	    this.options = $.extend({}, defaults, options);



	    // Derived selectors
	    this.triggerEl              = $(this.options.triggerEl);
	    this.containerEl            = $(this.options.containerEl);

	    // Allow for custom max pages - defaults to grabbing from DOM
	    this.maxPages               = ( this.options.maxPages ) ? this.options.maxPages : this.triggerEl.data('posts-loader-max-pages');

	    // Allow for Custom Ajax endpoint...
	    this.ajaxEndPoint           = ( this.options.customAjaxHandler ) ? this.options.customAjaxHandler : '/wp/wp-admin/admin-ajax.php';

	    // State Properties
	    this.loading                = false;
	    this.locked                 = false;
	    this.currentPage            = ( this.options.currentPage ) ? this.options.currentPage : this.triggerEl.data('posts-loader-curr-page');


	    // if there’s a data URL, overwrite the pagination URL
	    if ( this.triggerEl[0] !== undefined && this.triggerEl[0].hasAttribute('data-posts-loader-url')) {
	        this.options.paginationUrl = this.triggerEl[0].getAttribute('data-posts-loader-url').replace(/https?:\/\/(.*?)\//, '/');
	    }

	    // if there’s an endpoint
	    if ( this.triggerEl[0] !== undefined && this.triggerEl[0].hasAttribute('data-posts-loader-endpoint')) {

	        this.options.dataEndpoint = this.triggerEl.data('posts-loader-endpoint');
	    }

	    // shuffle the history state
	    if (this.options.paginationUrl.indexOf('%s') === -1) {
	        this.options.paginationUrl += '%s';
	    }

	    // Exit if there is no endpoint provided to get the data from
	    if ( !this.options.dataEndpoint ) {
	        return false;
	    }


	    // Blast off!
	    this.init();
	};

	PostsLoader.prototype.init = function() {

	    this._handleTriggerVisibility();
	    this._addListeners();
	    // parse off a query string
	    this._parseQueryString(this.options.paginationUrl);
	};

	PostsLoader.prototype._parseQueryString = function(sUri)
	{
	    // 0. init
	    this.oData = {
	        action: this.options.dataEndpoint
	    };
	    var self = this;

	    // 1. if there’s nothing to do, bail
	    if (sUri.indexOf('?') === -1) {
	        return;
	    }

	    // 2. strip off unnecessary bits
	    var sQs = sUri.replace(/^(.*?)\?/, '');

	    // 3. the last bit is always going to be the pagination var, so strip that
	    sQs = sQs.replace(/&?\w*=$/, '');

	    // 4. iterate!
	    sQs.split('&').forEach(function(sSub)
	    {
	        // a. explode on equals
	        var aM = sSub.split('=');

	        // b. set things
	        self.oData[aM[0]] = (aM.length > 1) ? aM[1] : '';
	    });
	};

	PostsLoader.prototype._addListeners = function() {
	    var self = this;

	    this.triggerEl.on('click', function(event){
	        self._fetchPosts(event);
	    });
	};

	PostsLoader.prototype._fetchPosts = function(event) {
	    var self = this;

	    event.preventDefault();

	    // If currently handling an existing request then bail out...
	    if ( this.loading ) {
	        return;
	    }

	    // set the current page
	    this.oData.paged = self.currentPage + 1;

	    // Query options
	    this.oData.postType     = this.options.postType;
	    this.oData.postsPerPage = this.options.postsPerPage;
	    this.oData.order        = this.options.order;
	    this.oData.orderBy      = this.options.orderBy;


	    $.ajax({
	        type       : 'GET',
	        data       : this.oData,
	        dataType   : 'html',
	        url        : self.ajaxEndPoint,
	        beforeSend : function() {
	            self.loading = true;
	            self.triggerEl.addClass(self.options.triggerActiveClass);
	        },
	        success    : function(data) {
	            self._handlePosts($(data)); // parse HTML using jQuery
	        },
	        error     : function(jqXHR, textStatus, errorThrown) {
	            self.containerEl.append( self.loadingErrorMsg );
	        }
	    });

	};

	PostsLoader.prototype._handleTriggerVisibility = function() {
	    // If we're showing the final page then don't allow more to be loaded
	    if ( this.currentPage >= this.maxPages ) {
	        this.triggerEl.hide();
	    }
	};


	PostsLoader.prototype._handlePosts = function(data) {
	    var self = this;

	    // Increment to reflect that we've now advanced to a new "page" of posts
	    this.currentPage++;

	    if ( data.length ) {

	        this._handleTriggerVisibility();

	        this.triggerEl.removeClass( this.options.triggerActiveClass );

	        // Append new posts after a short delay
	        setTimeout(function() {

	            if (self.containerEl[0].hasAttribute('data-columns') && (salvattore !== 'undefined')) {
	                salvattore.appendElements(self.containerEl[0], data);
	            } else {
	                self.containerEl.append(data);
	            }
	        }, 100);

	    }

	    // Update Browser history and address bar
	    if ( this.options.updateHistory && this._supportsHistoryAPI() ) {
	        this._updateHistory();
	    }

	    // Unset the flag which blocks repeated calling of this method
	    this.loading = false;
	};

	PostsLoader.prototype._supportsHistoryAPI = function(){
	    return !!(window.history && history.pushState);
	};


	PostsLoader.prototype._updateHistory = function() {
	    // Update page url to reflect the paged posts
	    var historyState = this.options.paginationUrl.replace('%s', this.currentPage);

	    history.pushState(null, null, historyState);
	};


	module.exports = PostsLoader;

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(1)))

/***/ },

/***/ 10:
/***/ function(module, exports, __webpack_require__) {

	var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/*!
	 * Salvattore 1.0.9 by @rnmp and @ppold
	 * https://github.com/rnmp/salvattore
	 */
	(function(root, factory) {
	  if (true) {
	    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [], __WEBPACK_AMD_DEFINE_FACTORY__ = (factory), __WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ? (__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__), __WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
	  } else if (typeof exports === 'object') {
	    module.exports = factory();
	  } else {
	    root.salvattore = factory();
	  }
	}(this, function() {
	/*! matchMedia() polyfill - Test a CSS media type/query in JS. Authors & copyright (c) 2012: Scott Jehl, Paul Irish, Nicholas Zakas, David Knight. Dual MIT/BSD license */

	if (!window.matchMedia) {
	    window.matchMedia = function() {
	        "use strict";

	        // For browsers that support matchMedium api such as IE 9 and webkit
	        var styleMedia = (window.styleMedia || window.media);

	        // For those that don't support matchMedium
	        if (!styleMedia) {
	            var style       = document.createElement('style'),
	                script      = document.getElementsByTagName('script')[0],
	                info        = null;

	            style.type  = 'text/css';
	            style.id    = 'matchmediajs-test';

	            script.parentNode.insertBefore(style, script);

	            // 'style.currentStyle' is used by IE <= 8 and 'window.getComputedStyle' for all other browsers
	            info = ('getComputedStyle' in window) && window.getComputedStyle(style, null) || style.currentStyle;

	            styleMedia = {
	                matchMedium: function(media) {
	                    var text = '@media ' + media + '{ #matchmediajs-test { width: 1px; } }';

	                    // 'style.styleSheet' is used by IE <= 8 and 'style.textContent' for all other browsers
	                    if (style.styleSheet) {
	                        style.styleSheet.cssText = text;
	                    } else {
	                        style.textContent = text;
	                    }

	                    // Test if media query is true or false
	                    return info.width === '1px';
	                }
	            };
	        }

	        return function(media) {
	            return {
	                matches: styleMedia.matchMedium(media || 'all'),
	                media: media || 'all'
	            };
	        };
	    }();
	}

	/*! matchMedia() polyfill addListener/removeListener extension. Author & copyright (c) 2012: Scott Jehl. Dual MIT/BSD license */
	(function(){
	    "use strict";

	    // Bail out for browsers that have addListener support
	    if (window.matchMedia && window.matchMedia('all').addListener) {
	        return false;
	    }

	    var localMatchMedia = window.matchMedia,
	        hasMediaQueries = localMatchMedia('only all').matches,
	        isListening     = false,
	        timeoutID       = 0,    // setTimeout for debouncing 'handleChange'
	        queries         = [],   // Contains each 'mql' and associated 'listeners' if 'addListener' is used
	        handleChange    = function(evt) {
	            // Debounce
	            clearTimeout(timeoutID);

	            timeoutID = setTimeout(function() {
	                for (var i = 0, il = queries.length; i < il; i++) {
	                    var mql         = queries[i].mql,
	                        listeners   = queries[i].listeners || [],
	                        matches     = localMatchMedia(mql.media).matches;

	                    // Update mql.matches value and call listeners
	                    // Fire listeners only if transitioning to or from matched state
	                    if (matches !== mql.matches) {
	                        mql.matches = matches;

	                        for (var j = 0, jl = listeners.length; j < jl; j++) {
	                            listeners[j].call(window, mql);
	                        }
	                    }
	                }
	            }, 30);
	        };

	    window.matchMedia = function(media) {
	        var mql         = localMatchMedia(media),
	            listeners   = [],
	            index       = 0;

	        mql.addListener = function(listener) {
	            // Changes would not occur to css media type so return now (Affects IE <= 8)
	            if (!hasMediaQueries) {
	                return;
	            }

	            // Set up 'resize' listener for browsers that support CSS3 media queries (Not for IE <= 8)
	            // There should only ever be 1 resize listener running for performance
	            if (!isListening) {
	                isListening = true;
	                window.addEventListener('resize', handleChange, true);
	            }

	            // Push object only if it has not been pushed already
	            if (index === 0) {
	                index = queries.push({
	                    mql         : mql,
	                    listeners   : listeners
	                });
	            }

	            listeners.push(listener);
	        };

	        mql.removeListener = function(listener) {
	            for (var i = 0, il = listeners.length; i < il; i++){
	                if (listeners[i] === listener){
	                    listeners.splice(i, 1);
	                }
	            }
	        };

	        return mql;
	    };
	}());

	// http://paulirish.com/2011/requestanimationframe-for-smart-animating/
	// http://my.opera.com/emoller/blog/2011/12/20/requestanimationframe-for-smart-er-animating

	// requestAnimationFrame polyfill by Erik Möller. fixes from Paul Irish and Tino Zijdel

	// MIT license

	(function() {
	    "use strict";

	    var lastTime = 0;
	    var vendors = ['ms', 'moz', 'webkit', 'o'];
	    for (var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
	        window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
	        window.cancelAnimationFrame = window[vendors[x]+'CancelAnimationFrame'] ||
	            window[vendors[x]+'CancelRequestAnimationFrame'];
	    }

	    if (!window.requestAnimationFrame)
	        window.requestAnimationFrame = function(callback, element) {
	            var currTime = new Date().getTime();
	            var timeToCall = Math.max(0, 16 - (currTime - lastTime));
	            var id = window.setTimeout(function() { callback(currTime + timeToCall); },
	              timeToCall);
	            lastTime = currTime + timeToCall;
	            return id;
	        };

	    if (!window.cancelAnimationFrame)
	        window.cancelAnimationFrame = function(id) {
	            clearTimeout(id);
	        };
	}());

	// https://developer.mozilla.org/en-US/docs/Web/API/CustomEvent

	if (typeof window.CustomEvent !== "function") {
	  (function() {
	    "use strict";
	    function CustomEvent(event, params) {
	      params = params || { bubbles: false, cancelable: false, detail: undefined };
	      var evt = document.createEvent('CustomEvent');
	      evt.initCustomEvent(event, params.bubbles, params.cancelable, params.detail);
	      return evt;
	     }

	    CustomEvent.prototype = window.Event.prototype;

	    window.CustomEvent = CustomEvent;
	  })();
	}

	/* jshint laxcomma: true */
	var salvattore = (function (global, document, undefined) {
	"use strict";

	var self = {},
	    grids = [],
	    mediaRules = [],
	    mediaQueries = [],
	    add_to_dataset = function(element, key, value) {
	      // uses dataset function or a fallback for <ie10
	      if (element.dataset) {
	        element.dataset[key] = value;
	      } else {
	        element.setAttribute("data-" + key, value);
	      }
	      return;
	    };

	self.obtainGridSettings = function obtainGridSettings(element) {
	  // returns the number of columns and the classes a column should have,
	  // from computing the style of the ::before pseudo-element of the grid.

	  var computedStyle = global.getComputedStyle(element, ":before")
	    , content = computedStyle.getPropertyValue("content").slice(1, -1)
	    , matchResult = content.match(/^\s*(\d+)(?:\s?\.(.+))?\s*$/)
	    , numberOfColumns = 1
	    , columnClasses = []
	  ;

	  if (matchResult) {
	    numberOfColumns = matchResult[1];
	    columnClasses = matchResult[2];
	    columnClasses = columnClasses? columnClasses.split(".") : ["column"];
	  } else {
	    matchResult = content.match(/^\s*\.(.+)\s+(\d+)\s*$/);
	    if (matchResult) {
	      columnClasses = matchResult[1];
	      numberOfColumns = matchResult[2];
	      if (numberOfColumns) {
	            numberOfColumns = numberOfColumns.split(".");
	      }
	    }
	  }

	  return {
	    numberOfColumns: numberOfColumns,
	    columnClasses: columnClasses
	  };
	};


	self.addColumns = function addColumns(grid, items) {
	  // from the settings obtained, it creates columns with
	  // the configured classes and adds to them a list of items.

	  var settings = self.obtainGridSettings(grid)
	    , numberOfColumns = settings.numberOfColumns
	    , columnClasses = settings.columnClasses
	    , columnsItems = new Array(+numberOfColumns)
	    , columnsFragment = document.createDocumentFragment()
	    , i = numberOfColumns
	    , selector
	  ;

	  while (i-- !== 0) {
	    selector = "[data-columns] > *:nth-child(" + numberOfColumns + "n-" + i + ")";
	    columnsItems.push(items.querySelectorAll(selector));
	  }

	  columnsItems.forEach(function append_to_grid_fragment(rows) {
	    var column = document.createElement("div")
	      , rowsFragment = document.createDocumentFragment()
	    ;

	    column.className = columnClasses.join(" ");

	    Array.prototype.forEach.call(rows, function append_to_column(row) {
	      rowsFragment.appendChild(row);
	    });
	    column.appendChild(rowsFragment);
	    columnsFragment.appendChild(column);
	  });

	  grid.appendChild(columnsFragment);
	  add_to_dataset(grid, 'columns', numberOfColumns);
	};


	self.removeColumns = function removeColumns(grid) {
	  // removes all the columns from a grid, and returns a list
	  // of items sorted by the ordering of columns.

	  var range = document.createRange();
	  range.selectNodeContents(grid);

	  var columns = Array.prototype.filter.call(range.extractContents().childNodes, function filter_elements(node) {
	    return node instanceof global.HTMLElement;
	  });

	  var numberOfColumns = columns.length
	    , numberOfRowsInFirstColumn = columns[0].childNodes.length
	    , sortedRows = new Array(numberOfRowsInFirstColumn * numberOfColumns)
	  ;

	  Array.prototype.forEach.call(columns, function iterate_columns(column, columnIndex) {
	    Array.prototype.forEach.call(column.children, function iterate_rows(row, rowIndex) {
	      sortedRows[rowIndex * numberOfColumns + columnIndex] = row;
	    });
	  });

	  var container = document.createElement("div");
	  add_to_dataset(container, 'columns', 0);

	  sortedRows.filter(function filter_non_null(child) {
	    return !!child;
	  }).forEach(function append_row(child) {
	    container.appendChild(child);
	  });

	  return container;
	};


	self.recreateColumns = function recreateColumns(grid) {
	  // removes all the columns from the grid, and adds them again,
	  // it is used when the number of columns change.

	  global.requestAnimationFrame(function render_after_css_mediaQueryChange() {
	    self.addColumns(grid, self.removeColumns(grid));
	    var columnsChange = new CustomEvent("columnsChange");
	    grid.dispatchEvent(columnsChange);
	  });
	};


	self.mediaQueryChange = function mediaQueryChange(mql) {
	  // recreates the columns when a media query matches the current state
	  // of the browser.

	  if (mql.matches) {
	    Array.prototype.forEach.call(grids, self.recreateColumns);
	  }
	};


	self.getCSSRules = function getCSSRules(stylesheet) {
	  // returns a list of css rules from a stylesheet

	  var cssRules;
	  try {
	    cssRules = stylesheet.sheet.cssRules || stylesheet.sheet.rules;
	  } catch (e) {
	    return [];
	  }

	  return cssRules || [];
	};


	self.getStylesheets = function getStylesheets() {
	  // returns a list of all the styles in the document (that are accessible).

	  var inlineStyleBlocks = Array.prototype.slice.call(document.querySelectorAll("style"));
	  inlineStyleBlocks.forEach(function(stylesheet, idx) {
	    if (stylesheet.type !== 'text/css' && stylesheet.type !== '') {
	      inlineStyleBlocks.splice(idx, 1);
	    }
	  });

	  return Array.prototype.concat.call(
	    inlineStyleBlocks,
	    Array.prototype.slice.call(document.querySelectorAll("link[rel='stylesheet']"))
	  );
	};


	self.mediaRuleHasColumnsSelector = function mediaRuleHasColumnsSelector(rules) {
	  // checks if a media query css rule has in its contents a selector that
	  // styles the grid.

	  var i, rule;

	  try {
	    i = rules.length;
	  }
	  catch (e) {
	    i = 0;
	  }

	  while (i--) {
	    rule = rules[i];
	    if (rule.selectorText && rule.selectorText.match(/\[data-columns\](.*)::?before$/)) {
	      return true;
	    }
	  }

	  return false;
	};


	self.scanMediaQueries = function scanMediaQueries() {
	  // scans all the stylesheets for selectors that style grids,
	  // if the matchMedia API is supported.

	  var newMediaRules = [];

	  if (!global.matchMedia) {
	    return;
	  }

	  self.getStylesheets().forEach(function extract_rules(stylesheet) {
	    Array.prototype.forEach.call(self.getCSSRules(stylesheet), function filter_by_column_selector(rule) {
	      // rule.media throws an 'not implemented error' in ie9 for import rules occasionally
	      try {
	        if (rule.media && rule.cssRules && self.mediaRuleHasColumnsSelector(rule.cssRules)) {
	          newMediaRules.push(rule);
	        }
	      } catch (e) {}
	    });
	  });

	  // remove matchMedia listeners from the old rules
	  var oldRules = mediaRules.filter(function (el) {
	      return newMediaRules.indexOf(el) === -1;
	  });
	  mediaQueries.filter(function (el) {
	    return oldRules.indexOf(el.rule) !== -1;
	  }).forEach(function (el) {
	      el.mql.removeListener(self.mediaQueryChange);
	  });
	  mediaQueries = mediaQueries.filter(function (el) {
	    return oldRules.indexOf(el.rule) === -1;
	  });

	  // add matchMedia listeners to the new rules
	  newMediaRules.filter(function (el) {
	    return mediaRules.indexOf(el) == -1;
	  }).forEach(function (rule) {
	      var mql = global.matchMedia(rule.media.mediaText);
	      mql.addListener(self.mediaQueryChange);
	      mediaQueries.push({rule: rule, mql:mql});
	  });

	  // swap mediaRules with the new set
	  mediaRules.length = 0;
	  mediaRules = newMediaRules;
	};


	self.rescanMediaQueries = function rescanMediaQueries() {
	    self.scanMediaQueries();
	    Array.prototype.forEach.call(grids, self.recreateColumns);
	};


	self.nextElementColumnIndex = function nextElementColumnIndex(grid, fragments) {
	  // returns the index of the column where the given element must be added.

	  var children = grid.children
	    , m = children.length
	    , lowestRowCount = 0
	    , child
	    , currentRowCount
	    , i
	    , index = 0
	  ;
	  for (i = 0; i < m; i++) {
	    child = children[i];
	    currentRowCount = child.children.length + (fragments[i].children || fragments[i].childNodes).length;
	  if(lowestRowCount === 0) {
	    lowestRowCount = currentRowCount;
	  }
	    if(currentRowCount < lowestRowCount) {
	      index = i;
	      lowestRowCount = currentRowCount;
	    }
	  }

	  return index;
	};


	self.createFragmentsList = function createFragmentsList(quantity) {
	  // returns a list of fragments

	  var fragments = new Array(quantity)
	    , i = 0
	  ;

	  while (i !== quantity) {
	    fragments[i] = document.createDocumentFragment();
	    i++;
	  }

	  return fragments;
	};


	self.appendElements = function appendElements(grid, elements) {
	  // adds a list of elements to the end of a grid

	  var columns = grid.children
	    , numberOfColumns = columns.length
	    , fragments = self.createFragmentsList(numberOfColumns)
	  ;

	  Array.prototype.forEach.call(elements, function append_to_next_fragment(element) {
	    var columnIndex = self.nextElementColumnIndex(grid, fragments);
	    fragments[columnIndex].appendChild(element);
	  });

	  Array.prototype.forEach.call(columns, function insert_column(column, index) {
	    column.appendChild(fragments[index]);
	  });
	};


	self.prependElements = function prependElements(grid, elements) {
	  // adds a list of elements to the start of a grid

	  var columns = grid.children
	    , numberOfColumns = columns.length
	    , fragments = self.createFragmentsList(numberOfColumns)
	    , columnIndex = numberOfColumns - 1
	  ;

	  elements.forEach(function append_to_next_fragment(element) {
	    var fragment = fragments[columnIndex];
	    fragment.insertBefore(element, fragment.firstChild);
	    if (columnIndex === 0) {
	      columnIndex = numberOfColumns - 1;
	    } else {
	      columnIndex--;
	    }
	  });

	  Array.prototype.forEach.call(columns, function insert_column(column, index) {
	    column.insertBefore(fragments[index], column.firstChild);
	  });

	  // populates a fragment with n columns till the right
	  var fragment = document.createDocumentFragment()
	    , numberOfColumnsToExtract = elements.length % numberOfColumns
	  ;

	  while (numberOfColumnsToExtract-- !== 0) {
	    fragment.appendChild(grid.lastChild);
	  }

	  // adds the fragment to the left
	  grid.insertBefore(fragment, grid.firstChild);
	};


	self.registerGrid = function registerGrid (grid) {
	  if (global.getComputedStyle(grid).display === "none") {
	    return;
	  }

	  // retrieve the list of items from the grid itself
	  var range = document.createRange();
	  range.selectNodeContents(grid);

	  var items = document.createElement("div");
	  items.appendChild(range.extractContents());


	  add_to_dataset(items, 'columns', 0);
	  self.addColumns(grid, items);
	  grids.push(grid);
	};


	self.init = function init() {
	  // adds required CSS rule to hide 'content' based
	  // configuration.

	  var css = document.createElement("style");
	  css.innerHTML = "[data-columns]::before{display:block;visibility:hidden;position:absolute;font-size:1px;}";
	  document.head.appendChild(css);

	  // scans all the grids in the document and generates
	  // columns from their configuration.

	  var gridElements = document.querySelectorAll("[data-columns]");
	  Array.prototype.forEach.call(gridElements, self.registerGrid);
	  self.scanMediaQueries();
	};

	self.init();

	return {
	  appendElements: self.appendElements,
	  prependElements: self.prependElements,
	  registerGrid: self.registerGrid,
	  recreateColumns: self.recreateColumns,
	  rescanMediaQueries: self.rescanMediaQueries,
	  init: self.init,

	  // maintains backwards compatibility with underscore style method names
	  append_elements: self.appendElements,
	  prepend_elements: self.prependElements,
	  register_grid: self.registerGrid,
	  recreate_columns: self.recreateColumns,
	  rescan_media_queries: self.rescanMediaQueries
	};

	})(window, window.document);

	return salvattore;
	}));


/***/ }

});