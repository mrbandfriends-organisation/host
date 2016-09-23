<?php
    use Roots\Sage\Utils;
?>

<?php echo Utils\ob_load_template_part('templates/components/hero', array(
    'post_id' => get_the_id(),
    'color'   => 'off-white'
)); ?>

<?php echo Utils\ob_load_template_part('templates/partials/uni/uni-information', array(
    'snippet' => 'uni/uni-information-main.php'
)); ?>

<?php echo Utils\ob_load_template_part('templates/partials/shared/featured-building', array(
    'snippet' => '/home/building'
)); ?>

<?php echo Utils\ob_load_template_part('templates/partials/shared/awards'); ?>
