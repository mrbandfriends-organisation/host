<?php
    use Roots\Sage\Utils;
?>




<main id="main-content" role="main" class="main-content">


  <?php echo Utils\ob_load_template_part('templates/partials/shared/header-carousel.php'); ?>


  <?php echo Utils\ob_load_template_part('templates/partials/building/building-intro'); ?>


  <?php while (have_posts()) : the_post(); ?>
        <?php echo the_post_thumbnail(); ?>
        <?php the_content(); ?>
  <?php endwhile; ?>


  <?php echo Utils\ob_load_template_part('templates/partials/building/building-rooms'); ?>


  <?php echo Utils\ob_load_template_part('templates/partials/building/building-facilities'); ?>

  <?php echo Utils\ob_load_template_part('templates/partials/shared/map'); ?>

  <?php echo Utils\ob_load_template_part('templates/partials/building/building-people'); ?>


  <?php echo Utils\ob_load_template_part('templates/partials/shared/awards'); ?>


</main>
