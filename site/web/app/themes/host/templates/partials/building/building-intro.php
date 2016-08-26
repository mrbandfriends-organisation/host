<?php
  /**
  * BUILDING INTRO
  **/
    use Roots\Sage\Utils;
?>


<?php
    $building_title_1 = get_field('title_1');
    $building_title_2 = get_field('title_2');
    $building_description = get_field('description');
?>


<h2>
  <?php echo esc_html($building_title_1); ?><br />
  <?php echo esc_html($building_title_2); ?>
</h2>

<?php echo $building_description; ?>

<?php
  // check if the repeater field has rows of data
  if( have_rows('links_downloads') ):

    echo "<h4>Cant wait to get settled in? You’ll need these downloads.</h4>";

   	// loop through the rows of data
      while ( have_rows('links_downloads') ) : the_row();

          // display a sub field value
          $button_text = get_sub_field('button_text');
          $link = get_sub_field('link');
?>

          <a href="<?php echo esc_html($link); ?>" class="btn">
            <?php echo esc_html($button_text); ?>
          </a>


<?php
      endwhile;
  else :
      // no rows found
  endif;
?>
