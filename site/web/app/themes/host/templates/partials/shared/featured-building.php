<?php
  /**
  * FEATURED BUILING
  **/
    use Roots\Sage\Utils;
?>

<?php
  $featured_building_title = get_field('featured_building_title');
  $featured_building = get_field('featured_building');

?>

<?php if( $featured_building ): ?>
    
<?php $featured_building_id = $featured_building->ID;
$featured_building_name = $featured_building->post_title;
$featured_building_url = $featured_building->guid;
$featured_building_description = get_field('description', $featured_building_id);
$featured_building_carousel_images = get_field('carousel_images', $featured_building_id); ?>

  <h2>
    <?php echo esc_html($featured_building_title); ?><br />
    <?php echo esc_html($featured_building_name); ?>
  </h2>

  <?php echo $featured_building_description; ?>

  <a href="<?php echo esc_html($featured_building_url); ?>" class="btn">Show me this property</a>


  <?php
  if( $featured_building_carousel_images ): ?>
      <ul>
          <?php foreach( $featured_building_carousel_images as $image ): ?>
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
