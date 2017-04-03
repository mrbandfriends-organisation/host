<?php

namespace Roots\Sage\Utils;


/**
 *  CHECK IF ALL ITEMS ARE EMPTY
 *  returns true if ALL of the arguments are empty
 *  if you need to check if ANY of the args are empty
 *  then you need aempty() (see below)
 */
function mempty() {
    foreach(func_get_args() as $arg)
        if(empty($arg))
            continue;
        else
            return false;
    return true;
}

/**
 *  CHECK IF ANY OF THE ITEMS ARE EMPTY
 *  returns true if ALL of the arguments are empty
 *  if you need to check if ANY of the args are empty
 *  then you need aempty() (see below)
 */
function aempty() {
    foreach(func_get_args() as $arg){ 
        if(empty($arg)) {
            return true;
        } 
    }
    return false;
}

/**
 * GET THEME IMAGE.
 *
 * results a path to an image within the currently active Theme
 */
function get_theme_img($file)
{
    return get_template_directory_uri().'/assets/images/'.$file;
}

/**
 * THEME IMAGE.
 *
 * prints a path to an assets in the currently active Theme
 */
function theme_img($file)
{
    echo esc_attr(get_wp_img($file));
}

/**
 * HIDE EMAIL.
 *
 * obfuscates an email address using WP built-ins
 *
 * @param string $email the email address to be "hidden"
 *
 * @return string the escaped email address
 */
function hide_email($email = null)
{
    if (!is_email($email)) {
        throw new \InvalidArgumentException('hide_email() expects a valid email address');
    }

    return antispambot($email);
}

/**
 * LIMIT WORDS.
 *
 * limits the length of a string of text to a given number of words
 *
 * @param string $content    the string of content to be "limited"
 * @param int    $word_limit the max number of words to return
 *
 * @return string the curtailed version of the original string
 */
function limit_words($content, $word_limit = 100)
{
    $content = explode(' ', $content, $word_limit);

    if (count($content) >= $word_limit) {
        array_pop($content);
        $content = implode(' ', $content).'...';
    } else {
        $content = implode(' ', $content);
    }

    $content = balanceTags($content);

    return $content;
}

/**
 * GET CURRENT PAGE URL.
 *
 * returns the full url for the current page
 *
 * @return string the full url for the current page
 */
function get_current_page_url()
{
    global $wp;

    return add_query_arg($_SERVER['QUERY_STRING'], '', home_url($wp->request));
}

/**
 * OUTPUT BUFFERED LOAD TEMPLATE PART.
 *
 * loads a given template part using output buffering
 * optionally including $data to be passed into template
 *
 * @param string $template_name name of the template to be located
 * @param array  $data          data to be passed into the template to be included
 */
function ob_load_template_part($template_name, $data = array())
{
    if (!strpos($template_name, '.php')) {
        $template_name = $template_name.'.php';
    }

    // Optionally provided an assoc array of data to pass to tempalte
    // and it will be extracted into variables
    if (is_array($data)) {
        extract($data);
    }

    ob_start();
    include locate_template($template_name);
    $var = ob_get_contents();
    ob_end_clean();

    return $var;
}

/**
 * CACHE BUST ASSET.
 *
 * Generates a Cache busting string for use
 * in filename based cache busting of assets
 * eg: main.109837987.css maps to main.css
 *
 * Uses last modified date of file to ensure
 * it's not updating randomly
 *
 * Note $file must be a file path on disk and
 * not a URI to a file.
 *
 * @param string $file path to file on disk
 *
 * @return [type] [description]
 */
function cache_bust_asset($file)
{
    if (!file_exists($file)) {
        return false;
    }

    $rtn = date('Ymdhis', filemtime($file));

    return $rtn;
}

/**
 * ESC TEXT AREA TRANSLATION.
 *
 * WordPress doesn't provide a means to escape fields which
 * could contain valid and invalid HTML (eg: Rich Text). This
 * functions provides sensible defaults for escaping text area
 * fields and runs through translation before returning result
 *
 * @param [type] $string_to_esc_and_translate [description]
 *
 * @return [type] [description]
 */
function esc_text_area__($string_to_esc_and_translate, $text_domain = 'englishstudio')
{
    return wp_kses_post($string_to_esc_and_translate);
    /*
    return wp_kses($string_to_esc_and_translate, array(
                'a' => array(
                        'href' => array(),
                        'title' => array(),
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array(),
                'p' => array(),
                'ul' => array(),
                'ol' => array(),
                'li' => array(),
                'h2' => array(),
                'h3' => array(),
                'h4' => array(),
        ));
    */
}
// Alias for above
function esc_textarea__($string_to_esc_and_translate, $text_domain = 'englishstudio')
{
    return esc_text_area__($string_to_esc_and_translate, $text_domain);
}

/**
 * Extract Tweet Entities.
 *
 * extract @mentions, hashtags and urls from Tweet text
 * and restore them to anchors
 */
function mrb_extract_tweet_entities($tweet_text)
{
    $tweet_text = preg_replace("/(([[:alnum:]]+:\/\/)|www\.)([^[:space:]]*)"."([[:alnum:]#?\/&=])/i", '<a href="\\1\\3\\4" target="_blank">'.'\\1\\3\\4</a>', $tweet_text);
    $tweet_text = preg_replace('#@([\\d\\w]+)#', '<a href="http://twitter.com/$1">$0</a>', $tweet_text);
    $tweet_text = preg_replace('/#([\\d\\w]+)/', '<a href="http://twitter.com/search?q=%23$1&src=hash">$0</a>', $tweet_text);

    return $tweet_text;
}

function get_post_thumb_src($post_id, $size = 'full')
{
    $post_thumb = false;

    $post_thumbnail_id = get_post_thumbnail_id($post_id);

    if ($post_thumbnail_id) {
        $post_thumb = wp_get_attachment_image_src($post_thumbnail_id, $size);
    }

    return $post_thumb;
}

function get_image_alt_by_id($attachment_id)
{
    $alt = get_post_meta($attachment_id, '_wp_attachment_image_alt');

    return empty($alt) ? null : $alt[0];
}

function generate_custom_breadcrumb($post, array $path_links = array())
{
    if (!empty($post->post_parent)) {
        array_push($path_links, array(
            'url' => get_the_permalink($post->post_parent),
            'text' => get_the_title($post->post_parent),
        ));
    }

    $custom_breadcrumbs = array(
        array(
            'url' => '/',
            'text' => 'Home',
        ),
    );

    foreach ($path_links as $path_link) {
        array_push($custom_breadcrumbs, $path_link);
    }

    array_push($custom_breadcrumbs, array(
        'text' => get_the_title($post->ID),
    ));

    return $custom_breadcrumbs;
}

/**
 * Remove a specified file format from a string. Commonly used to strip the .svg when using filepicker.
 */
function strip_file_format($file, $format = '.svg')
{
    return str_replace($format, '', $file);
}

function apply_content_filters($content)
{
    return apply_filters('the_content', __(get_the_content(), 'englishstudio'));
}

/**
 * CACHED QUERY.
 *
 * provides a wrapper around the Transients API to cache
 * any data in the Object Cache. Provides automatic refresh
 * of the Transient data if the transient has expired when
 * the function is called (via callback function).
 */
function cached_query($key, $update_function_callback, $max_age = HOUR_IN_SECONDS)
{
    $max_age = ES_CACHE_DURATION;

    $lang = get_language_code();

    $key_hash = TRANSIENT_CACHE_PREFIX.md5($lang.$key);

    if (false == ($response = get_transient($key_hash))) {
        //error_log("Cache MISS: " . $key);
        $response = call_user_func($update_function_callback);
        set_transient($key_hash, $response, $max_age);
    } else {
        //error_log("Cache HIT: " . $key);
    }

    return $response;
}

function gravity_form_exists($form_id)
{
    $forms = \GFFormsModel::get_forms();
    //var_dump($forms);

    foreach ($forms as &$form) {
        if ($form->id == $form_id) {
            return true;
        }
    }

    return false;
}

/**
 *  GET PAGE ID FROM SLUG.
 *
 * @param (type) (page_slug) Pages slug
 * @param (type) (slug_page_type) Post type if needed
 */
function get_id_by_slug($page_slug, $slug_page_type = 'page')
{
    $find_page = get_page_by_path($page_slug, OBJECT, $slug_page_type);
    if ($find_page) {
        return $find_page->ID;
    } else {
        return;
    }
}

/**
 * Constructs a formatted, sanitised HTML tag from a tagname and list of attributes.
 *
 * @param   sTag            the name of the tag to create
 * @param   aAttr           a key/value array of attributes and values
 */
function tag($sTag, $aAttr = [], $sContent = null, $bTrustContent = false)
{
    // 0. sanitise tag: can have any letter or numbers 1–6
    $sTag = preg_replace('/[^a-z1-6]/', '', $sTag);

    // 2. construct the tag
    $sReturn = "<{$sTag}";

    // 3. attributes
    foreach ($aAttr as $sName => $sValue) {
        // a. if it’s an empty, non-true value
        if (trim($sValue) === '') {
            continue;
        }

        // b. sanitise
        $sName = preg_replace('/[^a-z1-6\-]/', '', str_replace('_', '-', $sName));

        // c. output
        if ($sValue === true) {
            $sReturn .= " {$sName}";
        } else {
            $sReturn .= " {$sName}=\"".esc_attr($sValue).'"';
        }
    }

    // 3. finish opening element
    $sReturn .= '>';

    // 4. if there’s content
    if ($sContent !== null) {
        // make the content safe, if not trusted
        if (!$bTrustContent) {
            $sContent = esc_html($sContent);
        }

        $sReturn .= "{$sContent}</{$sTag}>";
    }

    return $sReturn;
}

/**
 * Icon function: shortcut for normal icon partial include.
 */
function icon($sIcon, $sTitle = null, $sClass = null)
{
    $args = array('icon' => $sIcon);
    if ($sTitle !== null) {
        $args['title'] = $sTitle;
    }
    if ($sClass !== null) {
        $args['classnames'] = $sClass;
    }

    return ob_load_template_part('templates/partials/shared/icon.php', $args);
}

/**
 * Gets post by slug.
 */
function get_post_by_slug($sSlug, $additional_args = [])
{
    $args = array_merge([
        'posts_per_page' => 1,
        'post_status' => 'publish',
        'post_type' => 'any',
    ], $additional_args, [
        'name' => $sSlug,
    ]);

    $qry = new \WP_Query($args);

    return (count($qry->posts) === 0) ? null : $qry->posts[0];
}

/**
 *  POST THUMB URL.
 *
 *  Getting URL of posts featured image
 *
 *  @param      int     Post's ID that you want to get featured images URL
 */
function post_thumb_url($post_id = null)
{
    if (!empty($post_id)) {
        $featured_img_id = get_post_thumbnail_id($post_id);
        $featured_img_url_array = wp_get_attachment_image_src($featured_img_id, 'thumbnail-size', true);
        $featured_img_url = $featured_img_url_array[0];
    }

    return $featured_img_url;
}


function get_post_thumb_data( $post_id, $size='full' ) {
    $rtn = [];

    $post_thumbnail_id = get_post_thumbnail_id( $post_id );

    $src_data = get_post_thumb_src( $post_id, $size, $post_thumbnail_id );

    $rtn['src']     = $src_data[0];
    $rtn['alt']     = get_image_alt_by_id( $post_thumbnail_id );

    return $rtn;
}

function cdnify($asset_path)
{
    if (WP_ENV !== 'development' && function_exists('get_rocket_cdn_url')) {
        return get_rocket_cdn_url($asset_path);
    } else {
        return $asset_path;
    }
}


/**
 *  Get posts with locations for map markers
 *
 * @param [array] $oConnectedPosts [Array of post objects]
 *
 * @return [array] $aSingleMarker [Array of markers]
 */
function get_posts_for_map_markers( $data_aray = array(), $aConnectedPosts = null ) {

    // 1. Checking if there are any connected markers
    if ( !empty($aConnectedPosts) ) {

        $aPosts        = $aConnectedPosts;
        $aSingleMarker = [];
        // var_dump($aPosts);

        // 2. Looping over connected markers object to build array each marker
        foreach ($aPosts as $aPost ) {
            $iId            = $aPost->ID;
            $sMarkerAddress = ( !empty(get_field('map_centre', $iId)) ? get_field('map_centre', $iId) : null );
            $sMarkerTitle   = ( !empty(get_field('map_label', $iId)) ? get_field('map_label', $iId) : null );

            // 3. Each single marker is turned into an array
            array_push($data_aray, array(
                'label'     => $sMarkerTitle,
                'type'      => 'building',
                'location'  => array(
                    'address' => $sMarkerAddress['address'],
                    'lat'     => $sMarkerAddress['lat'],
                    'lng'     => $sMarkerAddress['lng']
                ),
            ));

        }
        // 4. Returns array of markers
        return $data_aray;

    }
}
