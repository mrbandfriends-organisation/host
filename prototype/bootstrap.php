<?php
	require 'vendor/autoload.php';
    require 'tools/password-protect-staging.php';

    define('ROOT_DIR', __DIR__);

	/**
	 * Local Environment Config Data
	 * grab environment specific config details
	 */
	$local_data = json_decode( file_get_contents(".env.json"), true);

	// Error Reporting
	if ( $local_data['environment'] !== "production" ) {
		ini_set('display_startup_errors',1);
		ini_set('display_errors',1);
		error_reporting(-1);
	}

	/**
	 * Setup Plates PHP templating system
	 * http://platesphp.com/
	 */
	$templates = new League\Plates\Engine(ROOT_DIR . '/templates/');
	$templates->addFolder('layouts', ROOT_DIR . '/templates/layouts/');
	$templates->addFolder('pages', ROOT_DIR . '/templates/pages/');
	$templates->addFolder('partials', ROOT_DIR . '/templates/partials/');

	$path_info = !empty($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : (!empty($_SERVER['ORIG_PATH_INFO']) ? $_SERVER['ORIG_PATH_INFO'] : '');

	// Load URI extension using global variable
	$templates->loadExtension(new League\Plates\Extension\URI( $path_info ));



	/**
	 * Site Wide Config Details
	 * sets us resuable config for the entire system
	 */
	$assets_dir = 'assets';
	$site_data = array(
	    'img_dir'            			=> "{$assets_dir}/images",
	    'css_dir'            			=> "{$assets_dir}/css",
	    'js_dir'             			=> "{$assets_dir}/js",
	    'svg_dir'             			=> "{$assets_dir}/svg",

		'site_name' 					=> "",
		'site_desc' 					=> "",
		'use_web_fonts'					=> true,
	    'google_analytics_code'			=> "",
	    'bugherd_api_key'				=> "",
	    'unprotected_environments' 		=> array('local','production'),
	);


	/**
	 * Password Protection
	 * will require HTTP auth on environments that are
	 * not whitelisted as "unprotected" (above)
	 */
	password_protect_staging($local_data['environment'], $site_data['unprotected_environments']);

	// Make config data available throughout system
	$templates->addData($site_data);
	$templates->addData($local_data);

	// Initialise PlatesPHP Asset management extensions
	// http://platesphp.com/extensions/asset/
	$templates->loadExtension(new League\Plates\Extension\Asset(__DIR__, true));
