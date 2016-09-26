/**
 * POSTS LOADER
 *
 * a utility "class" the wraps the process of "lazy" loading Blog posts
 * over Ajax.
*/

var PostsLoader = function(options) {

    var defaults = {
        'dataEndpoint'          : false,
        'paginationUrl'         : '/blog/page/', // url format for pagination (eg: /blog/page/1/)
        'triggerEl'             : '.js-posts-loader-trigger', // element which initialising loading of new posts
        'containerEl'           : '.js-posts-loader-container', // element into which new posts should be inserted
        'loadingErrorMsg'       : '<p>Unfortunately, there was an error loading the additional posts. Please try again.</p>',
        'updateHistory'         : true, // whether or not to update the browser history on each page reload
        'triggerActiveClass'    : '-loading'
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
    if ( this.triggerEl[0] !== undefined && this.triggerEl[0].hasAttribute('data-posts-loader-url'))
        this.options.paginationUrl = this.triggerEl[0].getAttribute('data-posts-loader-url').replace(/https?:\/\/(.*?)\//, '/');

    // if there’s an endpoint
    if ( this.triggerEl[0] !== undefined && this.triggerEl[0].hasAttribute('data-posts-loader-endpoint'))

        this.options.dataEndpoint = this.triggerEl.data('posts-loader-endpoint');

    // shuffle the history state
    if (this.options.paginationUrl.indexOf('%s') === -1)
        this.options.paginationUrl += '%s';

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
    if (sUri.indexOf('?') === -1)
        return;

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
    if ( this.loading )
        return;

    // set the current page
    this.oData.paged = self.currentPage + 1;


    $.ajax({
        type       : 'GET',
        data       : this.oData,
        dataType   : 'html',
        url        : self.ajaxEndPoint,
        beforeSend : function() {
            console.log("AJAX!");
            self.loading = true;
            self.triggerEl.addClass(self.options.triggerActiveClass);
        },
        success    : function(data) {
            //console.log("data log" , data);
            $data = $(data);
            self._handlePosts($data);
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

    if ( $data.length ) {

        this._handleTriggerVisibility();

        this.triggerEl.removeClass( this.options.triggerActiveClass );

        // Append new posts after a short delay
        setTimeout(function() {

            if (self.containerEl[0].hasAttribute('data-columns') && (salvattore !== 'undefined')) {
                salvattore.appendElements(self.containerEl[0], $data);
            } else {
                self.containerEl.append($data);
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
