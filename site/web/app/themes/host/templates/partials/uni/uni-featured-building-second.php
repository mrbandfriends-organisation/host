<?php
    use Roots\Sage\Utils;

    $conneted_location_id = ( !empty($connected_location) ? $connected_location->post->ID : null );
?>

<div class="grid grid--vertical-l">
    <div class="gc l1-2 flex">
        <?php
            // Getting featured image form location
            $thumb_id        = get_post_thumbnail_id($featuerd_building_id);
            $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full-size', true);
            $thumb_url       = $thumb_url_array[0];

            echo Utils\ob_load_template_part('templates/components/bleed-image', array(
                'image' => $thumb_url,
                'alt'   => get_the_title() . ' Hall'
            ));
        ?>
    </div>
    <div class="gc l1-2 flex">
        <?php echo Utils\ob_load_template_part('templates/partials/shared/map-static', array(
           'map_label'  => get_field('map_label', $conneted_location_id),
           'map_centre' => get_field('map_centre', $conneted_location_id),
           'map_zoom'   => get_field('map_zoom', $conneted_location_id)
        )); ?>
    </div>
</div>
