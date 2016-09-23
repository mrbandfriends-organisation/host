<?php
    use Roots\Sage\Utils;

    $conneted_location_id = ( !empty($connected_location) ? $connected_location->post->ID : null );
?>

<div class="grid grid--vertical-l">
    <div class="gc l1-2">
        <?php echo Utils\ob_load_template_part('templates/components/bleed-image', array(
            'image'   => "http://host.dev/app/uploads/cache/2016/08/room_placeholder/4012389868.jpg"
        )); ?>
    </div>
    <div class="gc l1-2">
        <?php echo Utils\ob_load_template_part('templates/partials/shared/map-static', array(
           'map_label'  => get_field('map_label', $conneted_location_id),
           'map_centre' => get_field('map_centre', $conneted_location_id),
           'map_zoom'   => get_field('map_zoom', $conneted_location_id)
        )); ?>
    </div>
</div>
