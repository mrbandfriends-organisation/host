<?php
  /**
  * BUILDING PEOPLE
  **/
    use Roots\Sage\Utils;
?>


<?php
    $people_title = get_field('people_title');
    $people_description = get_field('people_description');
?>

<?php
  // People Gallery
  if( have_rows('people_photos') ):

      while ( have_rows('people_photos') ) : the_row();

          $photo = get_sub_field('photo');
          $photo_title = $photo['title'];
          $photo_url = $photo['url'];
?>

<?php
      endwhile;
  else :
      // no rows found
  endif;
?>

<?php
$main_content = Utils\ob_load_template_part('templates/snippets/building/our-people-introduction', compact('people_title', 'people_description'));

$aside_content = Utils\ob_load_template_part('templates/components/bleed-image', array(
    'image'  => $photo_url
));
 ?>

<?php
echo Utils\ob_load_template_part('templates/components/split-feature', [
    'color'   	 => 'red',
    'content' 	 => $main_content,
    'second'  	 => $aside_content
]);
 ?>
