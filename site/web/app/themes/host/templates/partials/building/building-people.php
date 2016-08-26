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


<h2>
  <?php echo esc_html($people_title); ?>
</h2>

<?php echo $people_description; ?>


<?php
  // People Gallery
  if( have_rows('people_photos') ):

      while ( have_rows('people_photos') ) : the_row();

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
