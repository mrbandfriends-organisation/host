<?php
  /**
  * CONTACT INTRO
  **/
  use Roots\Sage\Utils;
  use Roots\Sage\RoomsBuildings;
?>


<?php
    $details_title_1 = get_field('details_title_1');
    $details_title_2 = get_field('details_title_2');
    $details_description = get_field('details_description');
?>


<h2>
  <?php echo esc_html($details_title_1); ?><br />
  <?php echo esc_html($details_title_2); ?>
</h2>

<?php echo $details_description; ?>




  <?php
    $locations = (!empty($locations)) ? $locations : host_locations_find_all( ['order' => 'ASC', 'orderby' => 'title'] );

    if ( $locations->have_posts() ) :
  ?>

  <div id="tabs" class="c-tabs">

      <div class="c-tabs-nav">
      <?php
          $count_tab_index = 0;
          foreach ($locations->posts as $location) {
              $location_id = $location->ID;
              $location_title = $location->post_title;
              $count_tab_index++;
            ?>
            <a href="#<?php echo $location_title;?>" class="c-tabs-nav__link <?php if ( $count_tab_index == 1) { echo "is-active"; } ?>">
              <?php echo $location_title; ?>
            </a>
      <?php } ?>
      </div>



      <?php
          $count_tab_content = 0;
          foreach ($locations->posts as $location) {
              $location_id = $location->ID;
              $location_title = $location->post_title;
              $count_tab_content++;

              $connected_buildings_array = host_location_find_connected_buildings($location_id);

              $external = get_field('external_website', $location->ID);

              $connected_buildings = $connected_buildings_array;
            ?>



              <div id="<?php echo $location_title; ?>" class="c-tab <?php if ( $count_tab_content == 1) { echo "is-active"; } ?>">
                <div class="c-tab__content">

                  <h4><?php echo $location_title; ?></h4>
                  <?php
                    echo "<pre>";
                    print_r($connected_buildings->posts);
                    echo "</pre>";
                  ?>

                </div>
              </div>



      <?php } ?>



  </div>

  <?php endif; ?>
