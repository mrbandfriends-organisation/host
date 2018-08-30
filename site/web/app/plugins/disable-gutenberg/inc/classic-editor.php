<?php // Classic Editor

if (!defined('ABSPATH')) exit;

function disable_gutenberg_is_gutenberg_active() {
	
	if (
		in_array('gutenberg/gutenberg.php', (array) get_option('active_plugins')) || 
		(is_multisite() && array_key_exists('gutenberg/gutenberg.php', (array) get_site_option('active_sitewide_plugins'))) || 
		has_filter('load-post.php', 'gutenberg_intercept_edit_post') || 
		has_filter('replace_editor', 'gutenberg_init')
	) {
		
		return true;
		
	}
	
	return false;
	
}

function disable_gutenberg_init_actions() {
	
	if (!disable_gutenberg_is_gutenberg_active()) return;
	
	// Gutenberg plugin: remove the "Classic editor" row actions
	remove_action('admin_init', 'gutenberg_add_edit_link_filters');
	
	// gutenberg.php
	remove_action('admin_menu', 'gutenberg_menu');
	remove_action('admin_notices', 'gutenberg_wordpress_version_notice');
	remove_action('admin_init', 'gutenberg_redirect_demo');
	remove_action('admin_print_scripts-edit.php', 'gutenberg_replace_default_add_new_button');
	
	remove_filter('replace_editor', 'gutenberg_init');
	remove_filter('admin_url', 'gutenberg_modify_add_new_button_url');
	
	// lib/client-assets.php
	remove_action('wp_enqueue_scripts', 'gutenberg_register_scripts_and_styles', 5);
	remove_action('admin_enqueue_scripts', 'gutenberg_register_scripts_and_styles', 5);
	remove_action('wp_enqueue_scripts', 'gutenberg_common_scripts_and_styles');
	remove_action('admin_enqueue_scripts', 'gutenberg_common_scripts_and_styles');
	
	// lib/compat.php
	remove_filter('wp_refresh_nonces', 'gutenberg_add_rest_nonce_to_heartbeat_response_headers');
	
	// lib/plugin-compat.php
	remove_filter('rest_pre_insert_post', 'gutenberg_remove_wpcom_markdown_support');
	
	// lib/register.php
	remove_action('plugins_loaded', 'gutenberg_trick_plugins_into_registering_meta_boxes');
	remove_action('edit_form_top', 'gutenberg_remember_classic_editor_when_saving_posts');
	
	remove_filter('redirect_post_location', 'gutenberg_redirect_to_classic_editor_when_saving_posts');
	remove_filter('get_edit_post_link', 'gutenberg_revisions_link_to_editor');
	remove_filter('wp_prepare_revision_for_js', 'gutenberg_revisions_restore');
	remove_filter('display_post_states', 'gutenberg_add_gutenberg_post_state');
	
	// lib/rest-api.php
	remove_action('rest_api_init', 'gutenberg_register_rest_routes');
	remove_action('rest_api_init', 'gutenberg_add_taxonomy_visibility_field');
	
	remove_filter('rest_request_after_callbacks', 'gutenberg_filter_oembed_result');
	remove_filter('registered_post_type', 'gutenberg_register_post_prepare_functions');
	remove_filter('registered_taxonomy', 'gutenberg_register_taxonomy_prepare_functions');
	remove_filter('rest_index', 'gutenberg_ensure_wp_json_has_theme_supports');
	remove_filter('rest_request_before_callbacks', 'gutenberg_handle_early_callback_checks');
	remove_filter('rest_user_collection_params', 'gutenberg_filter_user_collection_parameters');
	remove_filter('rest_request_after_callbacks', 'gutenberg_filter_request_after_callbacks');
	
	// lib/meta-box-partial-page.php
	remove_action('do_meta_boxes', 'gutenberg_meta_box_save', 1000);
	remove_action('submitpost_box', 'gutenberg_intercept_meta_box_render');
	remove_action('submitpage_box', 'gutenberg_intercept_meta_box_render');
	remove_action('edit_page_form', 'gutenberg_intercept_meta_box_render');
	remove_action('edit_form_advanced', 'gutenberg_intercept_meta_box_render');
	
	remove_filter('redirect_post_location', 'gutenberg_meta_box_save_redirect');
	remove_filter('filter_gutenberg_meta_boxes', 'gutenberg_filter_meta_boxes');
	
	// Keep
	
	// lib/blocks.php
	// remove_filter('the_content', 'do_blocks', 9);
	
	// Continue to disable wpautop inside TinyMCE for posts that were started in Gutenberg
	// remove_filter('wp_editor_settings', 'gutenberg_disable_editor_settings_wpautop');
	
	// Keep the tweaks to the PHP wpautop
	// add_filter('the_content', 'wpautop');
	// remove_filter('the_content', 'gutenberg_wpautop', 8);
	
	// remove_action('init', 'gutenberg_register_post_types');
	
	add_filter('replace_editor', 'disable_gutenberg_replace');
	
}

function disable_gutenberg_replace($return) {
	
	if (true === $return) return $return;
	
	$suffix  = SCRIPT_DEBUG ? '' : '.min';
	$js_url  = plugin_dir_url(__FILE__) . 'js/';
	$css_url = plugin_dir_url(__FILE__) . 'css/';
	
	// Enqueued conditionally from legacy-edit-form-advanced.php
	wp_register_script('editor-expand', $js_url . "editor-expand$suffix.js", array('jquery', 'underscore'), false, 1);
	
	// The dependency 'tags-suggest' is also needed for 'inline-edit-post', not included
	wp_register_script('tags-box', $js_url . "tags-box$suffix.js", array('jquery', 'tags-suggest'), false, 1);
	wp_register_script('word-count', $js_url . "word-count$suffix.js", array(), false, 1);
	
	// The dependency 'heartbeat' is also loaded on most wp-admin screens, not included
	wp_register_script('autosave', $js_url . "autosave$suffix.js", array('heartbeat'), false, 1);
	wp_localize_script('autosave', 'autosaveL10n', array(
		'autosaveInterval' => AUTOSAVE_INTERVAL,
		'blog_id' => get_current_blog_id(),
	));
	
	wp_enqueue_script('post', $js_url . "post$suffix.js", array(
	//	'suggest', // deprecated
		'tags-box', // included
		'word-count', // included
		'autosave', // included
		'wp-lists', // not included, also dependency for 'admin-comments', 'link', and 'nav-menu'.
		'postbox', // not included, also dependency for 'link', 'comment', 'dashboard', and 'nav-menu'.
		'underscore', // not included, library
		'wp-a11y', // not included, library
	), false, 1);
	
	wp_localize_script('post', 'postL10n', array(
		'ok' => __('OK', 'classic-editor'),
		'cancel' => __('Cancel', 'classic-editor'),
		'publishOn' => __('Publish on:', 'classic-editor'),
		'publishOnFuture' =>  __('Schedule for:', 'classic-editor'),
		'publishOnPast' => __('Published on:', 'classic-editor'),
		/* translators: 1: month, 2: day, 3: year, 4: hour, 5: minute */
		'dateFormat' => __('%1$s %2$s, %3$s @ %4$s:%5$s', 'classic-editor'),
		'showcomm' => __('Show more comments', 'classic-editor'),
		'endcomm' => __('No more comments found.', 'classic-editor'),
		'publish' => __('Publish', 'classic-editor'),
		'schedule' => __('Schedule', 'classic-editor'),
		'update' => __('Update', 'classic-editor'),
		'savePending' => __('Save as Pending', 'classic-editor'),
		'saveDraft' => __('Save Draft', 'classic-editor'),
		'private' => __('Private', 'classic-editor'),
		'public' => __('Public', 'classic-editor'),
		'publicSticky' => __('Public, Sticky', 'classic-editor'),
		'password' => __('Password Protected', 'classic-editor'),
		'privatelyPublished' => __('Privately Published', 'classic-editor'),
		'published' => __('Published', 'classic-editor'),
		'saveAlert' => __('The changes you made will be lost if you navigate away from this page.', 'classic-editor'),
		'savingText' => __('Saving Draft&#8230;', 'classic-editor'),
		'permalinkSaved' => __('Permalink saved', 'classic-editor'),
	));
	
	wp_enqueue_style('classic-edit', plugin_dir_url(__FILE__) . "css/edit$suffix.css");
	
	// Other scripts and stylesheets:
	// wp_enqueue_script('admin-comments') is a dependency for 'dashboard', also used in edit-comments.php.
	// wp_enqueue_script('image-edit') and wp_enqueue_style('imgareaselect') are also used in media.php and media-upload.php.
	
	include_once(DISABLE_GUTENBERG_DIR . 'lib/classic-editor/classic-edit-form-advanced.php');
	
	return true;
	
}
