<?php
    use Roots\Sage\Utils;

    $src = ( !empty($src) ? $src : null );
    $alt = ( !empty($alt) ? 'alt="' . esc_html($alt) . '"' : null );
?>
 <img src="<?=esc_url($src); ?>" <?php echo Utils\esc_textarea__($alt); ?>>

