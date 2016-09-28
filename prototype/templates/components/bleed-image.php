<?php
    $sBg = (empty($image)) ? '' : ' style="background-image:url('.esc_attr($image).')"';
?>
<div class="box bleed-image"<?=$sBg; ?>>
    <img src="<?=esc_attr($image); ?>" alt="" class="bleed-image__image">
</div>
