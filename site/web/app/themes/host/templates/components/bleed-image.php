<?php
    use Roots\Sage\Utils;

    $sBg        = (empty($image)) ? '' : ' style="background-image:url('.esc_attr($image).')"';
    $modifier   = ( !empty($modifier) ? $modifier : null );
    $alt        = ( !empty($alt) ? 'alt="' . esc_html($alt) . '"' : null );
?>
<div class="box bleed-image <?php echo esc_attr($modifier); ?>"<?=$sBg; ?>>
    <img src="<?=esc_attr($image); ?>" <?php echo Utils\esc_textarea__($alt); ?> class="bleed-image__image">
</div>
