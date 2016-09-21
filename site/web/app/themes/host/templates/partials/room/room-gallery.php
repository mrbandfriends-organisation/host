<?php
    use Roots\Sage\Utils;
?>

<?php
    echo Utils\ob_load_template_part('templates/partials/shared/stacked-gallery', array(
    'images' => array(
        array(
            'image' => $image_1
        ),
        array(
            'image' => $image_2
        )
    )
)); ?>
