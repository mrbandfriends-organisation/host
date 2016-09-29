<?php
    Use Roots\Sage\Utils;
?>

<?php
    $main_content     = Utils\ob_load_template_part('templates/snippets/blog/view-all');
    $background_field = ( !empty(get_field('image','option')) ? get_field('image','option') : null );
    $background       = ( !empty($background_field) ? $background_field['url'] : null );

    echo Utils\ob_load_template_part('templates/components/billboard', array(
        'color'             => 'mint',
        'content'           => $main_content,
        'background'        => $background,
        'second_modifier'   => 'box box--mint multiply-bg'
)); ?>
