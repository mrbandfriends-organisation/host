<?php
  /**
  * ROOM DETAIL
  **/
    use Roots\Sage\Utils;
?>

<h2>
  It's all about<br />
  those little details.
</h2>



<?php
  // check if the repeater field has rows of data
  if( have_rows('living_space') ):
?>

    <h4>The living space.</h4>
    <ul>

  <?php
   	// loop through the rows of data
      while ( have_rows('living_space') ) : the_row();

          // display a sub field value
          $icon = get_sub_field('icon');
          $name = get_sub_field('name');
          $description = get_sub_field('description');
?>
        <li>
          <?php echo esc_html($icon); ?>
          <?php echo esc_html($name); ?>
          <?php echo esc_html($description); ?>
        </li>

<?php endwhile; ?>

  </ul>

<?php
  else :
  // no rows found
  endif;
?>





<?php
  // check if the repeater field has rows of data
  if( have_rows('the_amenities') ):
?>

    <h4>The amenities.</h4>
    <ul>

  <?php
   	// loop through the rows of data
      while ( have_rows('the_amenities') ) : the_row();

          // display a sub field value
          $icon = get_sub_field('icon');
          $name = get_sub_field('name');
          $description = get_sub_field('description');
?>
        <li>
          <?php echo esc_html($icon); ?>
          <?php echo esc_html($name); ?>
          <?php echo esc_html($description); ?>
        </li>

<?php endwhile; ?>

  </ul>

<?php
  else :
  // no rows found
  endif;
?>
