<?php
  /**
  * ROOM LOCATION
  **/
    use Roots\Sage\Utils;
?>

<?php
    $location_title = get_field('location_title', $parent_building_id);
    $location_overview = get_field('location_description', $parent_building_id);
    $location_city = $connected_location_name;
?>

<?php
$main_content = Utils\ob_load_template_part('templates/snippets/building/things-to-do-introduction', compact('location_title', 'location_overview', 'location_city'));

$aside_content = Utils\ob_load_template_part('templates/snippets/building/things-to-do-listing', compact('location_city'));

 ?>


<?php
echo Utils\ob_load_template_part('templates/components/split-feature', [
    'color'   	 => 'ink',
    'scrollable' => true,
    'content' 	 => $main_content,
    'second'  	 => $aside_content
]);
 ?>
