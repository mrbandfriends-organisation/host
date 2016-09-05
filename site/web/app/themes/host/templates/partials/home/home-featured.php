<?php
  /**
  * HOME FEATURED BUILING
  **/
    use Roots\Sage\Utils;
?>

<?php

$featured_buiding = get_field('featured_buiding');
$featured_buiding_id = $featured_buiding->ID;
$featured_buiding_title = $featured_buiding->post_title;
$featured_buiding_url = $featured_buiding->guid;
$featured_buiding_description = get_field('description', $featured_buiding_id);
$featured_buiding_carousel_images = get_field('carousel_images', $featured_buiding_id);

echo '<pre>';
    print_r( get_field('featured_buiding')  );
echo '</pre>';

?>

<?php if( $featured_buiding ): ?>

  <h2>
    Featured home:<br />
    <?php echo esc_html($featured_buiding_title); ?>
  </h2>

  <?php echo $featured_buiding_description; ?>

  <a href="<?php echo esc_html($featured_buiding_url); ?>" class="btn">Show me this property</a>


  <?php
  if( $featured_buiding_carousel_images ): ?>
      <ul>
          <?php foreach( $featured_buiding_carousel_images as $image ): ?>
              <li>
                  <a href="<?php echo $image['url']; ?>">
                       <img src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>" />
                  </a>
              </li>
          <?php endforeach; ?>
      </ul>
  <?php endif; ?>


<?php
  wp_reset_postdata();
  endif;
?>
