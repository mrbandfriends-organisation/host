<?php
    use Roots\Sage\Utils;
?>

<?php $parent_building = host_room_find_connected_building(get_the_id())->post ?>

<?php $parent_building_id = host_room_find_connected_building(get_the_id())->post->ID ?>

<?php echo Utils\ob_load_template_part('templates/partials/shared/header-carousel', array(
    'info_box' => Utils\ob_load_template_part('templates/snippets/shared/carousel-infobox', array(
        'building_name'     => $parent_building->post_title,
        'address_1'         => get_field('building_address_1', $parent_building_id),
        'town'              => get_field('building_address_town_city', $parent_building_id),
        'post_code'         => get_field('building_address_post_code', $parent_building_id),
        'phone'             => get_field('building_address_phone_no', $parent_building_id),
    ))
)); ?>

<?php echo Utils\ob_load_template_part('templates/partials/room/room-intro.php', compact('parent_building_id')); ?>

<?php echo Utils\ob_load_template_part('templates/partials/room/room-detail.php'); ?>

<?php echo Utils\ob_load_template_part('templates/partials/room/room-gallery.php'); ?>

<section class="band band--inset box box--padded box--fg-mint">
    <?php echo Utils\ob_load_template_part('templates/partials/room/room-prices.php'); ?>

    <?php echo Utils\ob_load_template_part('templates/partials/room/room-price-settings.php'); ?>
</section>

<?php echo Utils\ob_load_template_part('templates/partials/room/room-location.php', compact('parent_building_id')); ?>

<?php echo Utils\ob_load_template_part('templates/partials/shared/map', array(
    'iZoom' => get_field('map_zoom', $parent_building_id),
    'aCentre' => get_field('map_centre', $parent_building_id),
    'bFilter' => get_field('map_filters', $parent_building_id),
    'sFg' => get_field('map_foreground_colour', $parent_building_id),
    'sLabel' => get_field('map_label', $parent_building_id),
    'aPoi' => get_field('map_features', $parent_building_id)
)); ?>

<?php echo Utils\ob_load_template_part('templates/partials/shared/awards'); ?>
