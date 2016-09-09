<?php
    $sBg        = (empty($image)) ? '' : ' style="background-image:url('.esc_attr($image).')"';
    $modifier   = ( !empty($modifier) ? $modifier : null );
?>
<div class="box bleed-image <?php echo esc_attr($modifier); ?>"<?=$sBg; ?>>
    <img src="<?=esc_attr($image); ?>" alt="" class="bleed-image__image">
</div>
