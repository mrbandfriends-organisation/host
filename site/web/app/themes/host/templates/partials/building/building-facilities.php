<?php
  /**
  * BUILDING FACILITIES
  **/
    use Roots\Sage\Utils;
?>


<?php
    $facilities_title = get_field('facilities_title');
    $facilities_overview = get_field('facilities_overview');
    $facilities_location = 'London';

 if( have_rows('facilities_photos') ):

      while ( have_rows('facilities_photos') ) : the_row();

          $photo = get_sub_field('photo');
          $photo_url = $photo['url'];

      endwhile;
  endif;
?>

<?php
$main_content = Utils\ob_load_template_part('templates/snippets/building/facilities-introduction', compact('facilities_title', 'facilities_overview', 'facilities_location'));

$aside_content = Utils\ob_load_template_part('templates/components/bleed-image', [ 'image' => $photo_url ]);
?>


<?php
echo Utils\ob_load_template_part('templates/components/split-feature', [
    'color'   	 => 'white box--fg-red',
    'scrollable' => true,
    'content' 	 => $main_content,
    'second'  	 => $aside_content
]);
 ?>
