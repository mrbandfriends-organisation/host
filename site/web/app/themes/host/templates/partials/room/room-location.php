<?php
  /**
  * ROOM LOCATION
  **/
    use Roots\Sage\Utils;
?>


<?php
    $location_title = get_field('location_title');
    $location_description = get_field('location_description');
    $location_image = get_field('location_image');
?>


<h2>
  <?php echo esc_html($location_title); ?>
</h2>

<?php echo $location_description; ?>


<?php
  // Points of Interest
  if( have_rows('points_of_interest') ):

    echo "<ul>";

      while ( have_rows('points_of_interest') ) : the_row();

          $title = get_sub_field('title');
          $transport_time = get_sub_field('transport_time');
          $walking_time = get_sub_field('walking_time');

?>
          <li>
            <h4><?php echo esc_html($title); ?></h4>
            <?php echo esc_html($transport_time); ?>
            <?php echo esc_html($walking_time); ?>
          </li>
<?php
      endwhile;
  else :
      // no rows found
      echo "</ul>";
  endif;
?>


<img src="<?php echo $location_image['url']; ?>" alt="<?php echo $location_image['title']; ?>" />
