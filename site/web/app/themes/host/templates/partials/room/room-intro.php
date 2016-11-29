<?php
  /**
  * BUILDING INTRO
  **/
    use Roots\Sage\Utils;
?>

<?php
    $room_title_1 = get_the_title($parent_building_id) . ',';
    $room_title_2 = get_the_title();
    $room_title_3 = get_field('from_amount');
    $room_description = get_field('description');
?>

<?php

$main_content = Utils\ob_load_template_part('templates/snippets/room/introduction-text', array(
    'title_1'           => $room_title_1,
    'title_2'           => $room_title_2,
    'title_3'           => $room_title_3,
    'description'       => $room_description
));

$aside_content = Utils\ob_load_template_part('templates/snippets/room/introduction-aside');

 ?>

<?php echo Utils\ob_load_template_part('templates/components/billboard', array(
    'color'             => 'grape',
    'content'           => $main_content,
    'second'            => $aside_content
)); ?>
