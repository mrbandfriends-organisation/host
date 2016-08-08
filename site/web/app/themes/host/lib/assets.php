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

function asset_path($filename) {
  $dist_path = get_template_directory_uri() . '/dist/';
  $directory = dirname($filename) . '/';
  $file = basename($filename);
  static $manifest;

  if (empty($manifest)) {
    $manifest_path = get_template_directory() . '/dist/' . 'assets.json';
    $manifest = new JsonManifest($manifest_path);
  }

  if (array_key_exists($file, $manifest->get())) {
    return $dist_path . $directory . $manifest->get()[$file];
  } else {
    return $dist_path . $directory . $file;
  }
}

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
        'wpthumb'      => '&crop=true'
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
    } else {
        $is_direct_src = false;
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
            $aSrcset[] = wpthumb($image_ref, $sDim)." {$iSize}w";
        } else {
            $aSrcset[] = wp_get_attachment_image_url($image_ref, $sDim)." {$iSize}w";
        }
    }
    if (count($aSrcset) > 0)
    {
        $aAttr['srcset'] = join(', ', $aSrcset);
    }
    unset($aSrcset);


    // 4.5 - ensure we have a sizes attribute if the user didn't provide
    if ( empty( $aConf['sizes'] ) ) {
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
