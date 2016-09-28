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
