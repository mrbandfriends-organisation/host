<?php

namespace Roots\Sage\Assets;
use Roots\Sage\Utils;

/**
 * Get paths for assets
 */
class JsonManifest {
  private $manifest;

  public function __construct($manifest_path) {
    if (file_exists($manifest_path)) {
      $this->manifest = json_decode(file_get_contents($manifest_path), true);
    } else {
      $this->manifest = [];
    }
  }

  public function get() {
    return $this->manifest;
  }

  public function getPath($key = '', $default = null) {
    $collection = $this->manifest;
    if (is_null($key)) {
      return $collection;
    }
    if (isset($collection[$key])) {
      return $collection[$key];
    }
    foreach (explode('.', $key) as $segment) {
      if (!isset($collection[$segment])) {
        return $default;
      } else {
        $collection = $collection[$segment];
      }
    }
    return $collection;
  }
}

function asset_path($filename)
{
    $dist_path = get_template_directory_uri() . '/';
    $directory = dirname($filename);
    $file = basename($filename);
    static $manifest;

    // rewrite things
    switch ($directory)
    {
        case 'scripts':
            $directory = 'assets/js/dist/';
            break;
        case 'styles':
            $directory = 'assets/css/';
            break;
    }

    if (empty($manifest))
    {
        $manifest_path = get_template_directory() . '/assets/manifest.json';
        $manifest = new JsonManifest($manifest_path);
    }

    if (isset($manifest->get()[$file]))
    {
        return $dist_path . $directory . $manifest->get()[$file];
    }
    else
    {
        return $dist_path . $directory . $file;
    }
}

/**
 * Includes ASYNC attr in each SCRIPT tag, unless we’re in the admin, in which case… never mind.
 */
function make_scripts_async($tag)
{
    // if we’re in the admin, who cares
    if (is_admin())
    {
        return $tag;
    }

    // otherwise, modify tag to be async
    return str_replace('<script', '<script async', $tag);
}
add_filter('script_loader_tag', __NAMESPACE__.'\\make_scripts_async');

/**
 * Munges CSS so it doesn’t block loading/
 */
function hook_loadcss($tag)
{
    // 1. get a copy of the tag to munge
    $sMunge = $tag;

    // 2. start swapping things around
    // a. update @rel
    $sMunge = str_replace("rel='stylesheet'", "rel='preload'", $sMunge);
    // b. add @style and @onload
    $sMunge = str_replace('/>', " as='style' onload='this.rel=\"stylesheet\"'>", $sMunge);

    // 3. tidy things up
    $tag = trim($tag);

    return "{$sMunge}<noscript>{$tag}</noscript>\n";
    return $tag;
}
//add_filter('style_loader_tag', __NAMESPACE__.'\\hook_loadcss');

/**
 * Adds the last modification date of a file to the URL.
 */
function bust_caching($sUri)
{
    
    // Don't filter any scripts for the admin
    if (is_admin()) {
        return $sUri;
    }

    // 1. strip domain off the front of the source
    $sUri = preg_replace_callback('/https?:\/\/(.*?)\//', function($aM)
    {
        return ($aM[1] === 'fonts.googleapis.com') ? $aM[0] : '/';
    }, $sUri);


    // 2. strip query string
    $sUri  = preg_replace('/ver=([0-9\.]+)&?/', '', $sUri);

    $exploded = explode('?', $sUri);
    if (isset( $exploded[1])) {
        list($sUri, $sQs) = $exploded;
    } else {
        list($sUri) = $exploded;
    }

    // 2. work out the local path to the file
    $sPath  = dirname(ABSPATH).preg_replace('/\?(.*?)$/', '', $sUri);




    $sStamp = file_exists($sPath) ? ".".filemtime($sPath) : "";

    // 2.5 - reinstate the full url where required as we need this if we're using an origin PULL CDN
    $sUri = Utils\cdnify($sUri);

    $sSuffix = (defined('WP_ENV') && (WP_ENV !== 'development' && WP_ENV !== 'staging')) ? '.min' : '.min';

    // 4. create a new URL
    $min_asset = preg_replace('/\.(\w+)$/', "{$sSuffix}{$sStamp}.$1", $sUri).(empty($sQs) ? '' : "?{$sQs}");




    $std_asset = preg_replace('/\.(\w+)$/', "{$sStamp}.$1", $sUri).(empty($sQs) ? '' : "?{$sQs}");

    if (file_exists(dirname(ABSPATH) . $min_asset)) {
        return $min_asset;
    } else {
        return $std_asset;
    }
}
add_filter('script_loader_src', __NAMESPACE__.'\\bust_caching');
add_filter('style_loader_src', __NAMESPACE__.'\\bust_caching');

/**
 * Works in a similar way to wp_get_attachment_image, only returns an IMG with a srcset attribute
 *
 * @param   image_id    the ID of the attachment to generate markup for
 * @param   aConf       a hash of options
 */
 function get_responsive_image( $image_ref, $aConf = [] )
 {
     // 0. sanity check our input to make sure we’re not being passed null/a non-attachment
     if ( ($image_ref === null) )
     {
         return '';
     }

     // 1. get some defaults
     $aConf = array_merge([
         'dimensions'   => [ 1200, 768, 600, 320 ],
         'default_dim'  => 600,
         'aspect_ratio' => null,
         'class'        => 'attachment-thumbnail',
         'wpthumb'      => '&crop=true',
         'alt'          => '' // empty string is the minimumal requirement for alt
     ], $aConf);


     // 2. basic HTML attributes
     $aAttr = $aConf;
     unset($aAttr['dimensions'], $aAttr['default_dim'], $aAttr['wpthumb'], $aAttr['aspect_ratio']);  // assume everything else goes to HTML

     // 3. set appropriate aspect ratio
     $sDim = "width={$aConf['default_dim']}{$aConf['wpthumb']}";
     if ($aConf['aspect_ratio'] !== null)
     {
         $sDim .= '&height='.round($aConf['default_dim'] / $aConf['aspect_ratio']);
     }

     // 3.5 - get a valid src either from the attachment or using the src if this has been passed directly
     if ( !absint( $image_ref ) || ( get_post_type( $image_ref ) !== 'attachment' ) ) {
         $is_direct_src = true;
         $aAttr['src'] = $image_ref; // it's a direct image src already
         $aAttr['alt'] = $aConf['alt'];
     } else {
         $is_direct_src = false;

         if (empty( $aConf['alt'] ) ) {
             $aAttr['alt'] = Utils\get_image_alt_by_id( $image_ref );
         } else {
             $aAttr['alt'] = $aConf['alt'];
         }

         $aAttr['src'] = wp_get_attachment_image_url($image_ref, $sDim);
     }

     // 4. srcset
     $aSrcset = [];
     foreach ($aConf['dimensions'] AS $iSize)
     {
         // a. dimension string for WPThumb
         $sDim = "width={$iSize}{$aConf['wpthumb']}";

         // b. if there’s an aspect ratio…
         if ($aConf['aspect_ratio'] !== null)
         {
             $sDim .= '&height='.round($iSize / $aConf['aspect_ratio']);
         }

         // c. call out
         if ($is_direct_src) {
            $wpThumbCall    = wpthumb($image_ref, $sDim);
            $aSrcset[]      = $wpThumbCall . " {$iSize}w";
            $legacySrc[]        = $wpThumbCall;
         } else {     

            $getAttachCall  = wp_get_attachment_image_url($image_ref, $sDim);
            $aSrcset[]      = $getAttachCall . " {$iSize}w";
            $legacySrc[]    = $getAttachCall;
         }
     }
     if (count($aSrcset) > 0)
     {
         $aAttr['srcset']       = join(', ', $aSrcset);
         $aAttr['data-legacy-src']  = $legacySrc[0]; // get the biggest size
     }
     unset($aSrcset);


     // 4.5 - ensure we have a sizes attribute if the user didn't provide
     if ( empty( $aConf['sizes'] ) && !empty($aConf['dimensions']))
     {
         $largest_image = max( $aConf['dimensions'] );
         $aAttr['sizes'] = "(max-width: {$largest_image}px) 100vw, {$largest_image}px";
     }


     // 5. output
     return  Utils\tag('img', $aAttr);

 }


/**
 * Resonsive alternative to the_post_thumbnail.
 */
function the_responsive_thumbnail( $post_id = null, $aConf = [] )
{
    // 1. if there’s no postID, use the current one
    if ($post_id === null)
    {
        $post_id = get_the_ID();
    }

    // 2. check things
    if (!has_post_thumbnail($post_id))
    {
        return '';
    }

    // 3. get the thumbnail ID
    return get_responsive_image(get_post_thumbnail_id($post_id), $aConf);
}


function lazy_loaded_image($args) {

    $args = array_merge(array(
        'src' => null,
        'alt' => "",
        'classnames' => ""
    ), $args);

    if (!empty($args['src'])) {

        return Utils\ob_load_template_part('templates/partials/shared/lazy-image', array(
            'src'           => $args['src'],
            'alt'           => $args['alt'],
            'classnames'    => $args['classnames']
        ));
    }
}
