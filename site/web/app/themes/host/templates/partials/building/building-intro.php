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
    $booking_url = get_field('book_now_url');
    $booking_text = get_field('building_book_now_text');
?>

<?php
    $main_content = Utils\ob_load_template_part('templates/snippets/building/introduction-text', array(
        'title_1'           => $building_title_1,
        'title_2'           => $building_title_2,
        'description'       => $building_description,
        'booking_url'       => $booking_url,
        'booking_text'      => $booking_text,
        'connected_location_name' => $connected_location_name
    ));

    $aside_content = Utils\ob_load_template_part('templates/snippets/building/introduction-aside');
?>

<?php echo Utils\ob_load_template_part('templates/components/billboard', array(
    'color'             => 'sky',
    'content'           => $main_content,
    'main_modifier'     => 'building-intro',
    'second'            => $aside_content,
    'second_modifier'   => 'favouritable__wrapper favouritable__wrapper--dark'
)); ?>
