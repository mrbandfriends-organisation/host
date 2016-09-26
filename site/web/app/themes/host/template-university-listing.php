<?php
/**
 * Template Name: University Listing Template
 */
    use Roots\Sage\Utils;


?>

<?php echo Utils\ob_load_template_part('templates/components/listing', array(
    'post_loader_class'  => 'js-university-post-loader',
    'post_type'          => 'university',
    'post_per_page'      => 20,
    'loop_item_modifier' => 'article-tile--universities'
)); ?>
