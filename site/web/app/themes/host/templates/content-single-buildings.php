<?php
    use Roots\Sage\Utils;
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

    <?php echo Utils\ob_load_template_part('templates/partials/building/building-intro'); ?>

    <?php echo Utils\ob_load_template_part('templates/partials/building/building-rooms'); ?>

    <?php echo Utils\ob_load_template_part('templates/partials/building/building-facilities'); ?>

    <?php echo Utils\ob_load_template_part('templates/partials/building/building-things-to-do'); ?>

    <?php echo Utils\ob_load_template_part('templates/partials/shared/map'); ?>

    <?php echo Utils\ob_load_template_part('templates/partials/building/building-related-location-buildings'); ?>

    <?php echo Utils\ob_load_template_part('templates/partials/building/building-people'); ?>
