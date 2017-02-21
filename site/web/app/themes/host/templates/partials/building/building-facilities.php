<?php
  /**
  * BUILDING FACILITIES
  **/
    use Roots\Sage\Utils;
?>


<?php
    $facilities_title_1     = get_field('facilities_title_1');
    $facilities_title_2     = get_field('facilities_title_2');
    //$facilities_title       = get_field('facilities_title');
    $facilities_overview    = get_field('facilities_overview');
    $facilities_location    = $connected_location_name;
    $facilities_images      = get_field('facilities_photos');
?>

<?php
    $main_content = Utils\ob_load_template_part('templates/snippets/building/facilities-introduction', compact(
        'facilities_title_1',
        'facilities_title_2',
        'facilities_overview',
        'facilities_location'
    ));

    $aside_content = Utils\ob_load_template_part('templates/partials/shared/mini-carousel', array(
        'carousel_images' => $facilities_images
    ));
?>


<?php
echo Utils\ob_load_template_part('templates/components/split-feature', [
    'color'   	 => 'white box--fg-red',
    'scrollable' => true,
    'content' 	 => $main_content,
    'second'  	 => $aside_content,
    'id'         => 'details'
]);
 ?>
