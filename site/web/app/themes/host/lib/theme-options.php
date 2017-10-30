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
		'page_title' 	=> 'Language Settings',
		'menu_title'	=> 'Language Settings',
		'parent_slug'	=> 'site-options',
		'autoload' 		=> false,
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'StarRez Settings',
		'menu_title'	=> 'StarRez Settings',
		'parent_slug'	=> 'site-options',
		'autoload' 		=> false,
	));

    acf_add_options_sub_page(array(
		'page_title' 	=> 'Tracking settings',
		'menu_title'	=> 'Tracking Settings',
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
				'page_title' 	=> 'Awards',
				'menu_title'	=> 'Awards',
				'parent_slug'	=> 'content-slices',
				'autoload' 		=> false,
			));

			acf_add_options_sub_page(array(
				'page_title' 	=> 'Testimonials',
				'menu_title'	=> 'Testimonials',
				'parent_slug'	=> 'content-slices',
				'autoload' 		=> false,
			));

			acf_add_options_sub_page(array(
				'page_title' 	=> 'Room Prices',
				'menu_title'	=> 'Room Prices',
				'parent_slug'	=> 'content-slices',
				'autoload' 		=> false,
			));

			acf_add_options_sub_page(array(
				'page_title' 	=> 'Essential Student Kits',
				'menu_title'	=> 'Essential Student Kits',
				'parent_slug'	=> 'content-slices',
				'autoload' 		=> false,
			));
}
