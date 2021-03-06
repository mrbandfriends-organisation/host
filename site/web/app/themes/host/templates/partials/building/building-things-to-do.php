<?php
  /**
  * BUILDING FACILITIES
  **/
    use Roots\Sage\Utils;
?>


<?php
    $location_title_1  = get_field('location_title_1');
    $location_title_2  = get_field('location_title_2');
    $location_overview = get_field('location_description');
    $location_city     = $connected_location_name;
    $locations         = get_field('points_of_interest');
    $location_image    = get_field('location_image');
?>

<?php
    $main_content = Utils\ob_load_template_part('templates/snippets/building/things-to-do-introduction', compact('location_title_1', 'location_title_2', 'location_overview', 'location_city'));
    $aside_content = Utils\ob_load_template_part('templates/snippets/building/things-to-do-listing', compact('location_city', 'locations', 'location_image'));
?>

<?php
    echo Utils\ob_load_template_part('templates/components/split-feature', [
        'color'   	      => 'ink',
        'scrollable'      => true,
        'content' 	      => $main_content,
        'second'  	      => $aside_content,
        'second_modifier' => 'location-list',
        'id'              => 'location'
    ]);
?>
