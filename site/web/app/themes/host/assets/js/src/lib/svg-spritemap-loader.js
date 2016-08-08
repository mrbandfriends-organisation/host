/**
 * SVG SPRITEMAP
 * XHR load in a spritesheet
 */

var SVGSpriteLoader = function(url) {
    "use strict";

    this.url = url;

    this.loadSpriteSheet();
};

SVGSpriteLoader.prototype.loadSpriteSheet = function() {
    "use strict";

    var self = this;
    var request = new XMLHttpRequest();
    request.open('GET', this.url, true);

    request.onreadystatechange = function() {
      if (this.readyState === 4) {
        if (this.status >= 200 && this.status < 400) {
            self._insertSpriteSheet( request.responseText );
        }
      }
    };

    request.send();
};

SVGSpriteLoader.prototype._insertSpriteSheet = function(sheet) {
    "use strict";

    var div = document.createElement("div");
    div.style.display = "none";
    div.setAttribute('aria-hidden', true);
    div.innerHTML = sheet;
    document.body.insertBefore(div, document.body.childNodes[0]);
};

// Export
module.exports = SVGSpriteLoader;
