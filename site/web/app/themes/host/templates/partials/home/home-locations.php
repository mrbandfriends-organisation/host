<?php
  /**
  * HOME LOCATIONS
  **/
    use Roots\Sage\Utils;
?>

<?php
  $header_title_1 = get_field('header_title_1');
  $header_title_2 = get_field('header_title_2');
?>

<h2>
  <?php echo esc_html($header_title_1); ?><br />
  <?php echo esc_html($header_title_2); ?>
</h2>


<ul style="overflow:hidden;">
  <?php
    $location_query = new WP_Query( array(
      'post_type' => array( 'locations' )
    ) );

    while ( $location_query->have_posts() ) : $location_query->the_post();

      $carousel_images = get_field('carousel_images');
      $carousel_image = $carousel_images[0]['sizes']['medium'];
  ?>

    <li style="width:15%;border:solid 1px red;float:left;height:100px;">
      <a href="<?php echo the_permalink(); ?>">
        <?php echo the_title(); ?>
        <img src="<?php echo esc_html($carousel_image); ?>" />
      </a>
    </li>

    <?php endwhile; wp_reset_postdata(); ?>
</ul>
