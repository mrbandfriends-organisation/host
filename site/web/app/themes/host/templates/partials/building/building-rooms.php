<?php
  /**
  * BUILDING ROOMS
  **/
    use Roots\Sage\Utils;
    use Roots\Sage\RoomsBuildings;
?>

<?php
  $rooms_title_1 = get_field('rooms_title_1');
  $rooms_title_2 = get_field('rooms_title_2');
  $rooms_description = get_field('rooms_description');
?>

<?php
// Find connected pages

 $connected_rooms =  host_buildings_find_connected_rooms(get_the_id());

  // Display connected pages
  if ( $connected_rooms->have_posts() ) :
  ?>


  <h3>
    Take a look at<br />
    our room types.
  </h3>
  <pre>[INSERT ROOM CATEGORY LIST HERE]</pre>






    <?php while ( $connected_rooms->have_posts() ) : $connected_rooms->the_post();

        $room_category = get_the_category();
        $room_category = $room_category[0];

        $availability = get_field('availability');
        $from_amount = get_field('from_amount');
      ?>

          <?php RoomsBuildings\availability_status($availability); ?>

          <h3>
            <?php echo $room_category->cat_name; ?><br />
            From <?php echo esc_html($from_amount); ?>
          </h3>


          <?php
            // Facilities List
            if( have_rows('living_space') ):

                while ( have_rows('living_space') ) : the_row();
                    $description = get_sub_field('description');
          ?>
                      <?php echo esc_html($description) . ". "; ?>
          <?php
                endwhile;
            else :
                // no rows found
            endif;
          ?>


          <a href="<?php the_permalink(); ?>" class="btn">More information</a>


          <?php
            // Room Carousel
            if( have_rows('carousel_images') ):

                while ( have_rows('carousel_images') ) : the_row();

                    $photo = get_sub_field('image');
                    $photo_title = $photo['title'];
                    $photo_url = $photo['url'];
          ?>

            <img src="<?php echo esc_html($photo_url); ?>" alt="<?php echo esc_html($photo_title); ?>" title ="<?php echo esc_html($photo_title); ?>" />

          <?php
                endwhile;
            endif;
          ?>



    <?php endwhile; ?>

  <?php
    wp_reset_postdata();
    endif;
  ?>
  <?php $title = esc_html($rooms_title_1) . '<br />' . esc_html($rooms_title_2); ?>

  <?php Utils\ob_load_template_part('templates/components/room-list/index', [
      'id'    => 'dfjd',
      'title' => $title,
      'intro' => $rooms_description,
      'rooms' => $connected_rooms
  ]); ?>
