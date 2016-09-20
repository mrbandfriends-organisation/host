<?php
  /**
  * BUILDING INTRO
  **/
    use Roots\Sage\Utils;
?>


<?php
    $building_title_1 = get_field('title_1');
    $building_title_2 = get_field('title_2');
    $building_description = get_field('description');
?>

<?php

$main_content = Utils\ob_load_template_part('templates/snippets/building/introduction-text', array(
    'title_1'           => $building_title_1,
    'title_2'           => $building_title_2,
    'description'       => $building_description
));

$aside_content = Utils\ob_load_template_part('templates/snippets/building/introduction-aside');

 ?>

<?php echo Utils\ob_load_template_part('templates/components/billboard', array(
    'color'             => 'sky',
    'content'           => $main_content,
    'second'            => $aside_content,
    'second_modifier'   => 'favouritable__wrapper favouritable__wrapper--dark'
)); ?>
