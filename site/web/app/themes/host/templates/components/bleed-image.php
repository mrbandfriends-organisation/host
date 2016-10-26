<?php
    use Roots\Sage\Assets;

    $modifier   = ( !empty($modifier) ? $modifier : null );
    $alt        = ( !empty($alt) ? $alt : "" );
?>

<div class="box bleed-image <?php echo esc_attr($modifier); ?> lazyload" data-bg="<?php echo esc_attr($image); ?>">
	<?php 
		echo Assets\lazy_loaded_image(array(
	    	'src' => $image,
	    	'alt' => $alt,
	    	'classnames' => 'bleed-image__image'
	    ));
	?>
</div>

