<?php
  /**
  * BUILDING ROOMS
  **/
    use Roots\Sage\Utils;
    use Roots\Sage\RoomsBuildings;
?>

<?php
  $rooms_title_1 = get_field('rooms_title_1');
  $rooms_title_2 = get_field('rooms_title_2');
  $rooms_description = get_field('rooms_description');

  $connected_rooms = host_buildings_find_connected_rooms(get_the_id());
  $title = esc_html($rooms_title_1) . '<br />' . esc_html($rooms_title_2);
?>

<?php
  if ( !empty($connected_rooms->posts) ) {

    echo Utils\ob_load_template_part('templates/components/room-list/index', [
      'title' => $title,
      'intro' => $rooms_description,
      'rooms' => $connected_rooms
    ]);

  }
?>
