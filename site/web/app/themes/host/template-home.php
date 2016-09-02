<?php
/**
 * Template Name: Home Template
 */
 use Roots\Sage\Utils;
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>

<?php echo Utils\ob_load_template_part('templates/partials/awards'); ?>
