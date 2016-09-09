<?php

namespace Roots\Sage\ThemeOptions;


if( function_exists('acf_add_options_page') ) {

	// SITE OPTIONS
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

			acf_add_options_sub_page(array(
				'page_title' 	=> 'StarRez Settings',
				'menu_title'	=> 'StarRez Settings',
				'parent_slug'	=> 'site-options',
				'autoload' 		=> false,
			));


	// CONTENT SLICES
	acf_add_options_page(array(
		'page_title' 	=> 'Content Slices',
		'menu_title'	=> 'Content Slices',
		'menu_slug' 	=> 'content-slices',
		'capability'	=> 'edit_posts',
		'position' => '50',
		'redirect'		=> false
	));

			// SUB PAGES
			acf_add_options_sub_page(array(
				'page_title' 	=> 'Awards Settings',
				'menu_title'	=> 'Awards Settings',
				'parent_slug'	=> 'content-slices',
				'autoload' 		=> false,
			));

			acf_add_options_sub_page(array(
				'page_title' 	=> 'Room Prices Settings',
				'menu_title'	=> 'Room Prices Settings',
				'parent_slug'	=> 'content-slices',
				'autoload' 		=> false,
			));

}
