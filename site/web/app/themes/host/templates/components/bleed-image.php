<?php
    use Roots\Sage\Utils;

    $modifier   = ( !empty($modifier) ? $modifier : null );
    $alt        = ( !empty($alt) ? 'alt="' . esc_html($alt) . '"' : null );
?>

<div class="box bleed-image <?php echo esc_attr($modifier); ?> lazyload" data-bg="<?php echo esc_attr($image); ?>">
    <noscript>
    	<img src="<?=esc_attr($image); ?>" alt="<?php echo esc_attr($alt);?>" class="bleed-image__image"/>
	</noscript>
	<img data-src="<?=esc_attr($image); ?>" alt="<?php echo esc_attr($alt);?>" class="bleed-image__image lazyload" />
</div>

