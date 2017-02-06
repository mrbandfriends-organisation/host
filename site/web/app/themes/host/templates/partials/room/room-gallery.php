<?php
    use Roots\Sage\Utils;
   

    $gallery = (!empty(get_field('room_gallery')) ? get_field('room_gallery') : null);
    $panorama = (!empty(get_field('room_panorama')) ? get_field('room_panorama') : null);

?>

<?php if (!empty($panorama)): ?>
<div class="landmark">
<?php endif; ?>	
	<?php

	    echo Utils\ob_load_template_part('templates/partials/shared/stacked-gallery', array(
	        'grid_modifier' => 'stacked-gallery-container--min-height',
	        'images' => $gallery,
	        'number_thumbs' => 4,
	        'image_overlay_colour' => 'orange',
	    ));
	?>
<?php if (!empty($panorama)): ?>
</div>
<?php endif; ?>	


<?php if (!empty($panorama)): ?>
<div class="text-center">		
	<a href="<?php echo esc_attr($panorama); ?>" class="btn btn--primary js-room-panorama-trigger">View 360&deg; Panorama</a>
</div>
<?php endif; ?>