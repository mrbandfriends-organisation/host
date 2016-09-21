<?php
    use Roots\Sage\Utils;
?>

<?php
    // Setting up gallery
    $gallery = ( !empty(get_field('room_gallery')) ? get_field('room_gallery') : null );

    echo Utils\ob_load_template_part('templates/partials/shared/stacked-gallery', array(
        'images'                => $gallery,
        'number_thumbs'         => 4,
        'image_overlay_colour'  => 'orange'
    ));
?>
