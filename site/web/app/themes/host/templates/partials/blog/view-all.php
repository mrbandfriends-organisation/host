<?php
    Use Roots\Sage\Utils;
?>

<?php $main_content  = Utils\ob_load_template_part('templates/snippets/blog/view-all'); ?>
<?php $aside_content = Utils\ob_load_template_part('templates/snippets/blog/view-all-aside'); ?>

<?php echo Utils\ob_load_template_part('templates/components/billboard', array(
    'color'             => 'mint',
    'content'           => $main_content,
    'second'            => $aside_content,
    'second_modifier'   => 'box box--mint multiply-bg'
)); ?>
