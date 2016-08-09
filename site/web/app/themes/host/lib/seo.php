<?php

namespace Roots\Sage\SEO;

use Roots\Sage\Setup;


/**
 * PREVENT ROBOTS CRAWLING STAGING
 *
 * if env is not production add a blocking
 * meta tag to discourage robots getting involved
 */
function add_no_robots_meta() {
    if ( WP_ENV !== 'production' ) {
      $meta_tag='<meta name="robots" content="noindex">';
      echo $meta_tag;
    }
}
add_action('wp_head', __NAMESPACE__ . '\\add_no_robots_meta');

/**
 * MOVE YOAST TO BOTTOM OF EDIT SCREENS
 *
 * Ensure Yoast SEO options appear underneath other meta boxes
 */
function move_yoast_to_botttom() {
	return 'low';
}

add_filter( 'wpseo_metabox_prio', 'move_yoast_to_botttom');
