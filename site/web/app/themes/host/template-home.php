<?php
/**
 * Template Name: Home Template
 */
 use Roots\Sage\Utils;
?>


<main id="main-content" role="main" class="main-content">

  <?php echo Utils\ob_load_template_part('templates/partials/home/home-locations'); ?>


  <?php echo Utils\ob_load_template_part('templates/partials/home/home-featured'); ?>


  <?php echo Utils\ob_load_template_part('templates/partials/awards'); ?>

  <?php echo Utils\ob_load_template_part('templates/partials/home/home-investors'); ?>

</main>
