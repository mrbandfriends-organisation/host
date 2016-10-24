<?php
    use Roots\Sage\Utils;
    use Roots\Sage\Assets;

    $src = ( !empty($src) ? $src : null );
    $alt = ( !empty($alt) ? 'alt="' . esc_html($alt) . '"' : null );

    echo Assets\lazy_loaded_image(array(
    	'src' => $src,
    	'alt' => $alt
    ));
?>


