<?php
  /**
  * BUILDING FACILITIES
  **/
    use Roots\Sage\Utils;
?>


<?php
    $facilities_title = get_field('facilities_title');
    $facilities_overview = get_field('facilities_overview');
?>


<h2>
  <?php echo esc_html($facilities_title); ?>
</h2>

<?php echo $facilities_overview; ?>


<?php
  // Facilities List with icons
  if( have_rows('facilities_list') ):

    echo "<ul>";

      while ( have_rows('facilities_list') ) : the_row();

          $icon = get_sub_field('icon');
          $description = get_sub_field('description');
?>
          <li>
            <?php echo esc_html($icon); ?>
            <?php echo esc_html($description); ?>
          </li>
<?php
      endwhile;
  else :
      // no rows found
      echo "</ul>";
  endif;
?>


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
