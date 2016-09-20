<?php
    use Roots\Sage\Utils;
?>

    <?php echo Utils\ob_load_template_part('templates/partials/shared/header-carousel', array(
        'info_box' => Utils\ob_load_template_part('templates/partials/building/building-header-carousel-infobox')
    )); ?>

    <?php echo Utils\ob_load_template_part('templates/partials/building/building-intro'); ?>

    <?php echo Utils\ob_load_template_part('templates/partials/building/building-rooms'); ?>

    <?php echo Utils\ob_load_template_part('templates/partials/building/building-facilities'); ?>

    <?php echo Utils\ob_load_template_part('templates/partials/building/building-things-to-do'); ?>

    <?php echo Utils\ob_load_template_part('templates/partials/shared/map'); ?>

    <?php echo Utils\ob_load_template_part('templates/partials/building/building-related-location-buildings'); ?>

    <?php echo Utils\ob_load_template_part('templates/partials/building/building-people'); ?>
