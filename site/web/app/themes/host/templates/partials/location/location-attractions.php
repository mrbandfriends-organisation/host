<?php
  /**
  * LOCATION ATTRACTIONS
  **/
    use Roots\Sage\Utils;
?>


<?php
    $location_title = get_field('location_title');
    $location_description = get_field('location_description');

    $things_to_do_title = get_field('things_to_do_title');
    $things_to_do_image = get_field('things_to_do_image');
?>


<h2>
  <?php echo esc_html($location_title); ?>
</h2>

<?php echo $location_description; ?>


<?php
  // Facilities List with icons
  if( have_rows('things_to_do') ):

    echo "<ul>";

      while ( have_rows('things_to_do') ) : the_row();

          $item_number = get_sub_field('item_number');
          $item_name = get_sub_field('item_name');
?>
          <li>
            <?php echo esc_html($item_number); ?>
            <?php echo esc_html($item_name); ?>
          </li>
<?php
      endwhile;
  else :
      // no rows found
      echo "</ul>";
  endif;
?>


<img src="<?php echo $things_to_do_image['url']; ?>" alt="<?php echo $things_to_do_image['title']; ?>" />
