<?php
    use Roots\Sage\Utils;
?>




<main id="main-content" role="main" class="main-content">


    <?php echo Utils\ob_load_template_part('templates/partials/location/location-intro.php'); ?>

    <?php while (have_posts()) : the_post(); ?>
          <?php echo the_post_thumbnail(); ?>
    <?php endwhile; ?>


    <?php echo Utils\ob_load_template_part('templates/partials/location/location-buildings.php'); ?>

    <?php echo Utils\ob_load_template_part('templates/partials/location/location-attractions.php'); ?>

    <?php echo Utils\ob_load_template_part('templates/partials/map'); ?>



</main>
