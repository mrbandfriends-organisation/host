<?php
/**
 * Disable specified plugins in your development environment.
 *
 * This is a "Must-Use" plugin. Code here is loaded automatically before
 * regular plugins load. This is the only place from which regular plugins
 * can be disabled programatically.
 *
 * Place this code in a file in WP_CONTENT_DIR/mu-plugins or specify a
 * custom location by setting the WPMU_PLUGIN_URL and WPMU_PLUGIN_DIR
 * constants in wp-config.php.
 *
 * This code depends on a server environment variable of WP_ENV, which I set
 * to "development" or "production" in each particular server/environment.
 */

if (empty($_SERVER['WP_ENV']) || $_SERVER['WP_ENV'] != 'production') {
    $plugins = array(
        'stream/stream.php',
        'wp-rocket/wp-rocket.php',
        'sucuri-scanner/sucuri.php',
        'better-wp-security/better-wp-security.php',
        'akismet/akismet.php',
        'rewrite-rules-inspector/rewrite-rules-inspector.php'
    );
    require_once(ABSPATH . 'wp-admin/includes/plugin.php');
    deactivate_plugins($plugins);
}
