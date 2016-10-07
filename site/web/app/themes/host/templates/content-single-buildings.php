<?php
    use Roots\Sage\Utils;
?>

    <?php
        $connected_location = host_building_find_connected_location(get_the_id())->post;
        $connected_location_name = $connected_location->post_title;
     ?>

    <?php echo Utils\ob_load_template_part('templates/partials/shared/header-carousel', array(
        'info_box' => Utils\ob_load_template_part('templates/snippets/shared/carousel-infobox', array(
            'building_name'     => get_the_title(),
            'address_1'         => get_field('building_address_1'),
            'town'              => get_field('building_address_town_city'),
            'post_code'         => get_field('building_address_post_code'),
            'phone'             => get_field('building_address_phone_no'),
        ))
    )); ?>

    <?php echo Utils\ob_load_template_part('templates/partials/building/building-intro', compact('connected_location_name')); ?>

    <?php echo Utils\ob_load_template_part('templates/partials/building/building-rooms', compact('connected_location_name')); ?>

    <?php echo Utils\ob_load_template_part('templates/partials/building/building-facilities', compact('connected_location_name')
    ); ?>

    <?php echo Utils\ob_load_template_part('templates/partials/building/building-things-to-do', compact('connected_location_name')
    ); ?>

    <?php echo Utils\ob_load_template_part('templates/partials/shared/map', compact('connected_location_name')
    ); ?>

    <?php echo Utils\ob_load_template_part('templates/partials/building/building-related-location-buildings', compact('connected_location_name')
    ); ?>

    <?php echo Utils\ob_load_template_part('templates/partials/building/building-people', compact('connected_location_name')
    ); ?>

    <?php echo Utils\ob_load_template_part('templates/partials/shared/testimonials'); ?>
