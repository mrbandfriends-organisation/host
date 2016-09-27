<?php
  /**
  * CONTACT INTRO
  **/
    use Roots\Sage\Utils;
    use Roots\Sage\Extras;
    use Roots\Sage\RoomsBuildings;
?>


<?php
    $details_title_1 = get_field('details_title_1');
    $details_title_2 = get_field('details_title_2');
    $details_description = get_field('details_description');
?>

<section class="band band--inset box box--padded">
      <?php
        $locations = (!empty($locations)) ? $locations : host_locations_find_all( ['order' => 'ASC', 'orderby' => 'title'] );

        if ( $locations->have_posts() ) :
      ?>

        <div id="tabs" class="c-tabs">

            <h2 class="c-tabs__heading">
                <?php echo esc_html($details_title_1); ?><br />
                <?php echo esc_html($details_title_2); ?>
            </h2>

            <?php echo $details_description; ?>

            <div class="c-tabs-nav grid">
                <?php $count_tab_index = 0; ?>
                <?php foreach ($locations->posts as $location) : ?>
                    <?php
                        $location_id                = $location->ID;
                        $location_title             = $location->post_title;
                        $count_tab_index++;
                    ?>
                    <a href="#<?php echo $location_title;?>" class="c-tabs-nav__link gc l1-7 <?php if ( $count_tab_index == 1) { echo "is-active"; } ?>">
                      <?php echo $location_title; ?>
                    </a>
                <?php endforeach; ?>
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

                      <?php if ( !empty($connected_buildings->posts) ): ?>
                          <ul class="c-tab__listing grid grid--gutter">

                            <?php foreach ($connected_buildings->posts as $building):
                                $address_1 = get_field('building_address_1', $building->ID);
                                $address_2 = get_field('building_address_2', $building->ID);
                                $town_city = get_field('building_address_town_city', $building->ID);
                                $post_code = get_field('building_address_post_code', $building->ID);
                                $phone_no  = get_field('building_address_phone_no', $building->ID);
                                $link      = ( !empty($building->ID) ? get_the_permalink($building->ID) : null );

                                // build addresses
                                $address = join("\n", [
                                    $address_1,
                                    $address_2,
                                    $town_city,
                                    $post_code
                                ]);

                                // strip unneeded newlines
                                $address = trim(preg_replace("/\n\n+/", "\n", $address));

                                $google_maps_address = str_replace(" ", '+', esc_html($address));
                            ?>

                                <?php if ( !empty($address) && !empty($phone_no) && !empty($building->post_title) ): ?>
                                    <li class="gc l1-3 flex">
                                        <div class="c-tab__listing-item">
                                            <h3>
                                                <?php echo $building->post_title; ?><br>
                                                <?php echo $location_title; ?>
                                            </h3>

                                            <strong>Address</strong>
                                            <p>
                                                <?=str_replace("\n", '<br>', esc_html($address)); ?>
                                            </p>

                                            <a class="" href="https://www.google.com/maps?daddr=<?= $google_maps_address ?>); ?>" <?php Extras\link_open_new_tab_attrs(); ?>>
                                                Get directions
                                            </a>

                                            <strong>Call:</strong>
                                            <a href="tel:<?php echo $phone_no; ?>"><?php echo $phone_no; ?></a>
                                        </div>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>

                    <?php else: ?>
                          <h3 class="plain">Host Students currently have no buildings in <?php echo $location_title; ?></h3>
                    <?php endif; ?>

                        </ul>
                    </div>
                  </div>

          <?php } ?>


      </div>

      <?php endif; ?>
  </section>
