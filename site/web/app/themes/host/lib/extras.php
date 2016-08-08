<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');



/**
 * PHP JS VARIABLES
 *
 * makes PHP vars available in JavaScript
 */
function php_js_vars() {
?>
    <script>
    var LOCALISED_VARS = LOCALISED_VARS || {};

    LOCALISED_VARS.ajaxurl                           = <?php echo json_encode( admin_url( "admin-ajax.php" ) ) ?>;
    LOCALISED_VARS.ajaxnonce                         = <?php echo json_encode( wp_create_nonce( "lv_ajax_nonce" ) ) ?>;
    LOCALISED_VARS.stylesheet_directory_uri          = <?php echo json_encode( get_stylesheet_directory_uri() ) ?>;
    </script>
<?php
}
add_action( 'wp_head', __NAMESPACE__ . '\\php_js_vars' );



/**
 * ALLOW SVG UPLOADS TO MEDIA LIBRARY
 *
 */
function upload_svg_media_library($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_action('upload_mimes', __NAMESPACE__ . '\\upload_svg_media_library');
