<?php

namespace Roots\Sage\ThemeOptions;


if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Site Options',
		'menu_title'	=> 'Site Options',
		'menu_slug' 	=> 'site-options',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	// SUB PAGES
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Contact Settings',
		'menu_title'	=> 'Contact Settings',
		'parent_slug'	=> 'site-options',
		'autoload' 		=> false,
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Social Settings',
		'menu_title'	=> 'Social Settings',
		'parent_slug'	=> 'site-options',
		'autoload' 		=> false,
	));
	
}