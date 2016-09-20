<?php
/**
 * Template Name: Contact Template
 */
 use Roots\Sage\Utils;
?>

<?php echo Utils\ob_load_template_part('templates/components/hero', array(
    'post_id'  => get_the_id()
)); ?>

<?php echo Utils\ob_load_template_part('templates/partials/contact/contact-intro'); ?>
