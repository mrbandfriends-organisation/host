/**
 * WEBFONT MANAGMENT
 *
 * utilise fontfaceobserver as per best practice
 * https://www.zachleat.com/web/comprehensive-webfonts/
 *
 * Essentially, we load the critical fontfirst and then progressively load in other less critical
 * weights after the first load has completed. Note that until the @fontface is actually used in
 * the CSS then it will not be "loaded". As a result if we conditionally apply the fontface using
 * the classes added to the <html> element then we can control when the fonts are requested via
 * JavaScript rather than allowing browser to handle. This provides full control over FOUT/FOIT!
 *
 * Also note we have a optimisation for repeat loads which is in `head.php`. For more info see
 * https://www.zachleat.com/web-fonts/demos/fout-with-class.html        
 */

var Promise = require('es6-promise').Promise;

function timer(time) {
	return new Promise(function (resolve, reject) {
		setTimeout(reject, time);
	});
}

var FontFaceObserver = require('fontfaceobserver');


// Setup FontFaceObservers
var webFont = new FontFaceObserver('CircularWeb');

Promise.race([
	timer(3000), // if the fonts aint loaded fast enough then kick off big time!
	webFont.load()
]).then(function () {
	if (!document.documentElement.classList.contains('wf-active')) { // don't re-added if optimised loading has already added
	    //document.documentElement.className += " wf-circular-web-400-loaded wf-circular-web-600-loaded";
	    document.documentElement.className += " wf-active";
	}
	
	// Optimise for repeat view
	// https://www.zachleat.com/web-fonts/demos/fout-with-class.html
	sessionStorage.foutFontsLoaded = true;
}).catch(function () {
	document.documentElement.className += " wf-inactive";
});


