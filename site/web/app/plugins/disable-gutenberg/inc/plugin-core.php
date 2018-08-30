<?php // Plugin Core

if (!defined('ABSPATH')) exit;

function disable_gutenberg($is_enabled, $post_type) {
	
	$options = disable_gutenberg_get_options();
	
	$disable_all = (isset($options['disable-all']) && !empty($options['disable-all'])) ? true : false;
	
	if ($disable_all) return false;
	
	foreach (disable_gutenberg_get_enabled_user_roles() as $role) {
		
		$roles = disable_gutenberg_get_current_user_roles();
		
		if (is_array($roles) && in_array($role, $roles)) return false;
		
	}
	
	foreach (disable_gutenberg_get_enabled_post_types() as $type) {
		
		if ($post_type === $type) return false;
		
	}
	
	if (disable_gutenberg_disable_templates()) return false;
	
	if (disable_gutenberg_disable_ids()) return false;
	
	return $is_enabled;
	
}

function disable_gutenberg_get_current_user_roles($user = null) {
	
	if (is_user_logged_in()) {
		
		$user = $user ? new WP_User($user) : wp_get_current_user();
		
		return $user->roles ? (array) $user->roles : false;
		
	}
	
	return false;
	
}

function disable_gutenberg_get_user_roles() {
	
	$roles = get_editable_roles();
	
	$types = array();
	
	foreach ($roles as $key => $value) {
		
		$label = isset($value['name']) ? $value['name'] : null;
		
		$types[$key]['name']  = $key;
		$types[$key]['label'] = $label;
		
	}
	
	return apply_filters('disable_gutenberg_get_user_roles', $types);
	
}

function disable_gutenberg_get_enabled_user_roles() {
	
	$options = disable_gutenberg_get_options();
	
	$array = array();
	
	foreach ($options as $key => $value) {
		
		preg_match('/^user-role_(.*)$/i', $key, $matches);
		
		if (isset($matches[1]) && !empty($matches[1])) $array[] = $matches[1];
		
	}
	
	return apply_filters('disable_gutenberg_get_enabled_user_roles', $array);
	
}

function disable_gutenberg_get_post_types() {
	
	$post_types = get_post_types(array(), 'objects');
	
	$unset = array('attachment', 'revision', 'nav_menu_item', 'custom_css', 'customize_changeset', 'oembed_cache');
	
	$unset = apply_filters('disable_gutenberg_post_types_unset', $unset);
	
	$types = array();
	
	foreach($post_types as $key => $post_type) {
		
		$types[$key]['name']  = $post_type->name;
		$types[$key]['label'] = $post_type->label;
		
		if (in_array($post_type->name, $unset) || !post_type_supports($post_type->name, 'custom-fields')) unset($types[$key]);
		
	}
	
	return apply_filters('disable_gutenberg_get_post_types', $types);
	
}

function disable_gutenberg_get_enabled_post_types() {
	
	$options = disable_gutenberg_get_options();
	
	$array = array();
	
	foreach ($options as $key => $value) {
		
		preg_match('/^post-type_(.*)$/i', $key, $matches);
		
		if (isset($matches[1]) && !empty($matches[1])) $array[] = $matches[1];
		
	}
	
	return apply_filters('disable_gutenberg_get_enabled_post_types', $array);
	
}

function disable_gutenberg_disable_templates() {
	
	$excluded = array();
	
	$template = '';
	
	$post_id = isset($_GET['post']) ? intval($_GET['post']) : null;
	
	if (is_admin() && !empty($post_id)) {
		
		$options = disable_gutenberg_get_options();
		
		$excluded = isset($options['templates']) ? $options['templates'] : null;
		
		$excluded = array_map('trim', explode(',', $excluded));
		
		$template = get_page_template_slug($post_id);
		
	}
	
	return in_array($template, $excluded);
	
}

function disable_gutenberg_disable_ids() {
	
	$excluded = array();
	
	$post_id = isset($_GET['post']) ? intval($_GET['post']) : null;
	
	if (is_admin() && !empty($post_id)) {
		
		$options = disable_gutenberg_get_options();
		
		$excluded = isset($options['post-ids']) ? $options['post-ids'] : null;
		
		$excluded = array_map('trim', explode(',', $excluded));
		
	}
	
	return in_array($post_id, $excluded);
	
}

function disable_gutenberg_disable_nag() {
	
	$options = disable_gutenberg_get_options();
	
	$disable_nag = (isset($options['disable-nag']) && !empty($options['disable-nag'])) ? true : false;
	
	if ($disable_nag) remove_filter('try_gutenberg_panel', 'wp_try_gutenberg_panel');
	
}

function disable_gutenberg_menu_items() {
	
	$options = disable_gutenberg_get_options();
	
	$hide_plugin    = (isset($options['hide-menu']) && !empty($options['hide-menu'])) ? true : false;
	$hide_gutenberg = (isset($options['hide-gut'])  && !empty($options['hide-gut']))  ? true : false;
	
	if ($hide_plugin)    remove_submenu_page('options-general.php', 'disable-gutenberg');
	if ($hide_gutenberg) remove_menu_page('gutenberg');
	
}
