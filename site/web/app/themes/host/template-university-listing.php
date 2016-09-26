<?php
/**
 * Template Name: University Listing Template
 */
 use Roots\Sage\Utils;
?>

<?php echo Utils\ob_load_template_part('templates/components/listing', array(
    'post_per_page'  => 3,
    'post_type'      => 'university'
)); ?>
