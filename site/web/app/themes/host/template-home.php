<?php
/**
 * Template Name: Home Template
 */
 use Roots\Sage\Utils;
?>



<?php echo Utils\ob_load_template_part('templates/partials/home/home-locations'); ?>

<?php echo Utils\ob_load_template_part('templates/partials/home/home-reasons', array(
    'snippet' => '/home/reason'
)); ?>


<?php echo Utils\ob_load_template_part('templates/partials/shared/featured-building', array(
    'snippet' => '/home/building'
)); ?>

<?php echo Utils\ob_load_template_part('templates/partials/shared/awards', array(
    'snippet'               => '/home/awards',
    'awards_logos_modifier' => '-left'
)); ?>

<?php echo Utils\ob_load_template_part('templates/partials/home/home-investors', array(
    'snippet' => '/home/investors'
)); ?>
