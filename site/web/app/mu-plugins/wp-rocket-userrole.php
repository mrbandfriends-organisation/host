<?php
defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );
/**
 * Plugin Name: WP Rocket | Settings Access for Site Editors 
 * Description: Allows site editors to access and modify WP Rocket’s settings.
 * Author:      WP Rocket Support Team
 * Author URI:  http://wp-rocket.me/
 * License:     GNU General Public License v3 or later
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

/**
 * Set minimum user capability for WP Rocket.
 * @param  string $capability WordPress user capability
 * @return string             WordPress user capability
 */
function rocket_for_editor( $capability ) {

	if ( current_user_can( 'editor' ) ) {
		return 'editor';
	}

	return $capability;
}
add_filter( 'option_page_capability_wp_rocket', 'rocket_for_editor' );
add_filter( 'rocket_capacity', 'rocket_for_editor' );