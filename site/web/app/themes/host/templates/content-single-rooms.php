<?php
    use Roots\Sage\Utils;
?>




<main id="main-content" role="main" class="main-content">

  <?php echo Utils\ob_load_template_part('templates/partials/header-carousel.php'); ?>

  <?php echo Utils\ob_load_template_part('templates/partials/room/room-intro.php'); ?>

  <?php echo Utils\ob_load_template_part('templates/partials/room/room-detail.php'); ?>

  <?php echo Utils\ob_load_template_part('templates/partials/room/room-prices.php'); ?>

  <?php echo Utils\ob_load_template_part('templates/partials/room/room-price-settings.php'); ?>

  <?php echo Utils\ob_load_template_part('templates/partials/room/room-location.php'); ?>


  <?php echo Utils\ob_load_template_part('templates/partials/map'); ?>

  <?php echo Utils\ob_load_template_part('templates/partials/awards'); ?>


</main>
