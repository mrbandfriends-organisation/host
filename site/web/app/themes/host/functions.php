<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/disable-remove.php',
  'lib/seo.php',
  'lib/acf-tweaks.php',
  'lib/gravity-forms.php',
  'lib/tracking.php',
  'lib/theme-options.php',
  'lib/utils.php',
  'lib/shortcodes.php',
  'lib/availability.php',
  'lib/walkers.php',
  'lib/ajax-load-posts.php',
  'lib/redirection.php'
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);
