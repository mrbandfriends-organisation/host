<?php
    use Roots\Sage\Utils;
?>

<?php $parent_building = host_room_find_connected_building(get_the_id())->post ?>

<?php $parent_building_id = host_room_find_connected_building(get_the_id())->post->ID ?>


<main id="main-content" role="main" class="main-content">

    <?php echo Utils\ob_load_template_part('templates/partials/shared/header-carousel', array(
        'info_box' => Utils\ob_load_template_part('templates/snippets/shared/carousel-infobox', array(
            'building_name'     => $parent_building->post_title,
            'address_1'         => get_field('building_address_1'),
            'town'              => get_field('building_address_town_city'),
            'post_code'         => get_field('building_address_post_code'),
            'phone'             => get_field('building_address_phone_no'),
        ))
    )); ?>

  <?php echo Utils\ob_load_template_part('templates/partials/room/room-intro.php'); ?>

  <?php echo Utils\ob_load_template_part('templates/partials/room/room-detail.php'); ?>

  <?php echo Utils\ob_load_template_part('templates/partials/room/room-prices.php'); ?>

  <?php echo Utils\ob_load_template_part('templates/partials/room/room-price-settings.php'); ?>

  <?php echo Utils\ob_load_template_part('templates/partials/room/room-location.php'); ?>

  <?php echo Utils\ob_load_template_part('templates/partials/shared/map'); ?>

  <?php echo Utils\ob_load_template_part('templates/partials/shared/awards'); ?>


</main>
