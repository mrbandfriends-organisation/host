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

<section id="contact-halls" class="band band--inset box box--padded">
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

            <div class="c-tabs-nav">
                <?php $count_tab_index = 0; ?>
                <?php foreach ($locations->posts as $location) : ?>
                    <?php
                        $location_id         = $location->ID;
                        $location_title      = $location->post_title;
                        $connected_buildings = host_location_find_connected_buildings($location_id);
                    ?>
                    <?php // Only shows building if it has an address ?>
                    <?php //if ( $has_address === true ): ?>
                        <a href="#<?php echo sanitize_title($location_title);?>" data-index="<?= esc_attr($count_tab_index); ?>" class="c-tabs-nav__link">
                            <?php echo esc_html($location_title); ?>
                        </a>
                        <?php $count_tab_index++; ?>
                    <?php //endif; ?>
                <?php endforeach; ?>
            </div>



            <?php $count_tab_content = 0; ?>
            <?php foreach ($locations->posts as $location) : ?>
                <?php
                    $location_id            = $location->ID;
                    $location_title         = $location->post_title;
                    $connected_buildings    = host_location_find_connected_buildings($location_id);
                    $count_tab_content++;

                    // Checking if each building has an address
                    foreach ($connected_buildings->posts as $building) {
                        $building_id = $building->ID;

                        if ( get_field('building_address_post_code', $building_id) ) {
                            $has_address = true;
                        } else {
                            $has_address = false;
                        }
                    }
                ?>
                <div id="<?php echo sanitize_title($location_title); ?>" class="c-tab <?php if ( $count_tab_content == 1) { echo "is-active"; } ?>">
                    <div class="c-tab__content">
                        <?php if ( $has_address === true ): ?>

                        <?php if ( !empty( $connected_buildings->posts ) ): ?>
                            <ul class="c-tab__listing grid grid--gutter">
                                <?php foreach ($connected_buildings->posts as $building):
                                    $address_1 = get_field('building_address_1', $building->ID);
                                    $address_2 = ( !empty(get_field('building_address_2', $building->ID)) ? get_field('building_address_2', $building->ID) : null );
                                    $town_city = get_field('building_address_town_city', $building->ID);
                                    $post_code = get_field('building_address_post_code', $building->ID);
                                    $phone_no  = get_field('building_address_phone_no', $building->ID);
                                    $email  = get_field('building_email_address', $building->ID);
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

                                    $google_maps_address = join("\n", [
                                        $town_city . " ",
                                        $post_code
                                    ]);
                                    // Removing spaces for google maps string
                                    $google_maps_address = str_replace(" ", '+', esc_html($google_maps_address));
                                ?>

                                    <?php if ( !empty($address) ): ?>
                                        <li class="gc l1-3 flex">
                                            <div class="c-tab__listing-item">
                                                <h3>
                                                    <?php echo esc_html($building->post_title); ?><br>
                                                    <?php echo esc_html($location_title); ?>
                                                </h3>

                                                <strong>Address</strong>
                                                <p>
                                                    <?=str_replace("\n", '<br>', esc_html($address)); ?>
                                                </p>

                                                <a class="" href="https://www.google.com/maps?daddr=<?= esc_attr($google_maps_address) ?>" <?php Extras\link_open_new_tab_attrs(); ?>>
                                                    Get directions
                                                </a>

                                                <?php if (!empty($phone_no)): ?>
                                                  <strong>Call:</strong>
                                                  <a href="tel:<?php echo esc_attr($phone_no); ?>"><?php echo esc_html($phone_no); ?></a>
                                                <?php endif; ?>

                                                <?php if (!empty($email)): ?>
                                                  <strong>Email:</strong>
                                                  <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                                                <?php endif; ?>

                                            </div>
                                        </li>
                                    <?php endif; ?>

                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        <?php else: ?>
                            <div class="box box--more-padding">
                                <?php // ?>
                                <h3 class="text-center plain">Host currently have no buildings in <?php echo esc_html($location_title); ?></h3>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php endif; ?>
</section>
