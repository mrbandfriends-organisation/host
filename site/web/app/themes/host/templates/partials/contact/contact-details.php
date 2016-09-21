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

              $connected_buildings = $connected_buildings_array;
            ?>


              <div id="<?php echo $location_title; ?>" class="c-tab <?php if ( $count_tab_content == 1) { echo "is-active"; } ?>">
                <div class="c-tab__content">

                  <?php if ( !empty($connected_buildings->posts) ) { ?>

                    <?php
                      foreach ($connected_buildings->posts as $building) {
                        $address_1 = get_field('building_address_1', $building->ID);
                        $address_2 = get_field('building_address_2', $building->ID);
                        $town_city = get_field('building_address_town_city', $building->ID);
                        $post_code = get_field('building_address_post_code', $building->ID);
                        $phone_no = get_field('building_address_phone_no', $building->ID);
                      ?>

                        <div style="border: solid 2px red; width: 300px; float: left; margin-right: 20px;">

                            <h3><?php echo $building->post_title; ?></h3>
                            <h4><?php echo $location_title; ?></h4>

                            <strong>Address</strong><br />
                            <?php echo $address_1; ?><br />
                            <?php if (!empty($address_2)) { echo $address_2 . "<br />"; } ?>
                            <?php echo $town_city; ?><br />
                            <?php echo $post_code; ?><br />
                            <br />
                            <strong>Call:</strong><br />
                            <a href="tel:<?php echo $phone_no; ?>"><?php echo $phone_no; ?></a>

                        </div>

                      <?php } ?>

                    <?php } else { ?>

                      <h3>Host Students currently have no buildings in <?php echo $location_title; ?></h3>

                    <?php } ?>

                </div>
              </div>

      <?php } ?>


  </div>

  <?php endif; ?>
