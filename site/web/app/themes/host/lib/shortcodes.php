<?php

namespace Roots\Sage\Shortcodes;
use Roots\Sage\Utils;


/**
 * CUSTOM MR B GOOGLE TRANSLATE
 *
 * embeds a target div and placeholder select ready for
 * Google translate API to target and replace with Google's
 * translation widet. See app.js for the example. Note
 * we are able to pass in the ID to allow us to have different
 * shortcode output for offcanvas vs on canvas nav
 */
add_shortcode( 'mrb_google_translate', function($attrs) {

	$args = shortcode_atts( array(
        'id' => 'google-translate-target-large'
    ), $attrs );

	return '<div id="' . $args['id'] . '">
		<select class="js-translation-loading-placeholder">
			<option>Loading...</script>
		</select>
	</div>';
} );