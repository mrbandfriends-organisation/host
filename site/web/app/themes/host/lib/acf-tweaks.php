<?php

namespace Roots\Sage\ACFTweaks;

use Roots\Sage\Setup;

/**
 * HIDE ACF GUI
 *
 * making use of ACF save-to-JSON functionality means it's a very bad
 * idea to make changes to Custom Fields via the GUI on a non-VC env.
 * As a result this function will hide the GUI on a non VC env.
 */
function my_acf_hide_gui( $show ) {

    if (WP_ENV !== "development") { // show on version controlled envs
      return false;
    }

    return true;
}
add_filter('acf/settings/show_admin', __NAMESPACE__ . '\\my_acf_hide_gui');

function acf_add_gmaps_key() {

	acf_update_setting('google_api_key', GMAPS_API_KEY);
}

add_action('acf/init', __NAMESPACE__ . '\\acf_add_gmaps_key');

function book_now_url_default($value, $post_id, $field) {
  if ($value === NULL) {
    // value is NULL because it was never saved
    $value = 'https://portal.host-students.com/StarRezPortalX/E046082B/15/144/Book_a_Room-Find_your_Host___';
  }
  return $value;
}
add_filter('acf/load_value/name=book_now_url', __NAMESPACE__ . '\\book_now_url_default', 10, 3);

function building_book_now_text_default($value, $post_id, $field) {
  if ($value === NULL) {
    // value is NULL because it was never saved
    $value = 'Book this building';
  }
  return $value;
}
add_filter('acf/load_value/name=building_book_now_text', __NAMESPACE__ . '\\building_book_now_text_default', 10, 3);

function room_book_now_text_default($value, $post_id, $field) {
  if ($value === NULL) {
    // value is NULL because it was never saved
    $value = 'Book this room';
  }
  return $value;
}
add_filter('acf/load_value/name=room_book_now_text', __NAMESPACE__ . '\\room_book_now_text_default', 10, 3);