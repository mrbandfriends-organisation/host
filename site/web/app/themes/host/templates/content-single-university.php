<?php
    use Roots\Sage\Utils;
?>

<?php echo Utils\ob_load_template_part('templates/components/hero', array(
    'post_id' => get_the_id(),
    'color'   => 'off-white'
)); ?>

<?php //echo Utils\ob_load_template_part('templates/partials/shared/featured-building'); ?>

<?php //echo Utils\ob_load_template_part('templates/partials/shared/awards'); ?>
