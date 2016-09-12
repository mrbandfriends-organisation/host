<?php
/**
 * Template Name: About Template
 */
 use Roots\Sage\Utils;
?>

<?php echo Utils\ob_load_template_part('templates/components/hero.php', array(
    'post_id'     => get_the_id()
)); ?>

<?php echo Utils\ob_load_template_part('templates/partials/about/introduction'); ?>

<?php echo Utils\ob_load_template_part('templates/partials/shared/testimonials'); ?>
