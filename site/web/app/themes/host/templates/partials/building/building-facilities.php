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
?>

<?php
$main_content = Utils\ob_load_template_part('templates/snippets/building/facilities-introduction', compact('facilities_title', 'facilities_overview', 'facilities_location'));

$aside_content = Utils\ob_load_template_part('templates/snippets/building/facilities-listing', compact('facilities_location'));

 ?>


<?php
echo Utils\ob_load_template_part('templates/components/split-feature', [
    'color'   	 => 'ink',
    'scrollable' => true,
    'content' 	 => $main_content,
    'second'  	 => $aside_content
]);
 ?>

<h2>
  <?php echo esc_html($facilities_title); ?>
</h2>

<?php echo $facilities_overview; ?>


<?php
  // Facilities Gallery
  if( have_rows('facilities_photos') ):

      while ( have_rows('facilities_photos') ) : the_row();

          $photo = get_sub_field('photo');
          $photo_title = $photo['title'];
          $photo_url = $photo['url'];
?>

  <img src="<?php echo esc_html($photo_url); ?>" alt="<?php echo esc_html($photo_title); ?>" title ="<?php echo esc_html($photo_title); ?>" />


<?php
      endwhile;
  else :
      // no rows found
  endif;
?>
