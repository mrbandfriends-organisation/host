<?php
/*
Plugin Name:  Host - Functionality Plugin
Plugin URI:
Description:  Custom functionality Plugin for this project's website. Deactivating this Plugin will break the website.
Version:      1.0.0
Author:       Mr B and Friends
Author URI:   http://www.mrbandfriends.co.uk
License:      Restricted
*/

namespace HostPluginNamespace;

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

// Composer Autoloader
require_once __DIR__.'/vendor/autoload.php';

// Plugin Autoloader
require_once __DIR__.'/autoloader.php';

// Grab the core Plugin class
$plugin_core = Core::class;

// Register Plugin Activation / Deactivation
register_activation_hook(__FILE__, array($plugin_core, 'activate'));
register_deactivation_hook(__FILE__, array($plugin_core, 'deactivate'));

//  Initialise
add_action('plugins_loaded', array($plugin_core, 'init'));
