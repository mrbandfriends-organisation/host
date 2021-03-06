<?php
/** Staging */
ini_set('display_errors', 0);
define('WP_DEBUG_DISPLAY', false);
define('SCRIPT_DEBUG', false);
/** Disable all file modifications including updates and update notifications */
define('DISALLOW_FILE_MODS', true);

// Disable updates on non-Production
define('AUTOMATIC_UPDATER_DISABLED', true);

// Enable Tag Manager on Staging for testing
define('GOOGLE_TAG_MANAGER_CODE', 'GTM-M2J9ZC');