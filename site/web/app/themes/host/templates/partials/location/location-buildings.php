<?php
  /**
  * LOCATION BUILDINGS
  **/
    use Roots\Sage\Utils;
    use Roots\Sage\RoomsBuildings;
?>


<?php
// Find connected pages
$connected_buildings = new WP_Query( array(
  'connected_type' => 'building_to_location',
  'connected_items' => get_queried_object(),
  'nopaging' => true,
) );

  // Display connected pages
  if ( $connected_buildings->have_posts() ) :


   while ( $connected_buildings->have_posts() ) : $connected_buildings->the_post();

          $building_description = get_field('description');
          $availability = get_field('availability');
          $prices_from = get_field('prices_from');


          $building_address_1 = get_field('building_address_1');
          $building_address_2 = get_field('building_address_2');
          $building_address_town_city = get_field('building_address_town_city');
          $building_address_post_code = get_field('building_address_post_code');
          $building_address_phone_no = get_field('building_address_phone_no');

          $external_website = get_field('external_website');
          $website_url = get_field('website_url');
      ?>


        <div style="border: solid 1px red; padding: 10px;">
          <h3><?php echo the_title(); ?></h3>
          <h4><?php RoomsBuildings\availability_status($availability); ?></h4>
          <?php echo $building_description; ?>

          <h5>Address.</h5>
          <?php echo esc_html($building_address_1); ?><br />
          <?php echo esc_html($building_address_2); ?><br />
          <?php echo esc_html($building_address_town_city); ?><br />
          <?php echo esc_html($building_address_post_code); ?><br />

          <h5>Call.</h5>
          <?php echo esc_html($building_address_phone_no); ?>


          <?php if( $external_website ) {
            foreach( $external_website as $external ):

                if ($external == "external") { ?>

                  <a href="<?php echo esc_html($website_url); ?>" target="_blank" class="btn">Take me to the website</a>

            <?php
            } endforeach;
          } else { ?>

            <a href="<?php the_permalink(); ?>" class="btn">Show me this property</a>

          <?php } ?>

          <h4>Prices from <?php echo esc_html($prices_from); ?></h4>
          <?php echo the_post_thumbnail(); ?>

        </div>


    <?php endwhile; ?>

  <?php
    wp_reset_postdata();
    endif;
  ?>
