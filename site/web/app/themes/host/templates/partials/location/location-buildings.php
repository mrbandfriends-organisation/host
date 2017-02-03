<?php
    /**
     * LOCATION BUILDINGS.
     **/
    use Roots\Sage\Utils;
    use Roots\Sage\RoomsBuildings;
    use Roots\Sage\Extras;

    $location_title = get_the_title();

    // Getting query using plugin template function. If there is PPC ID set then the query
    // if queried by this fields value
    if( isset($_GET['location_ppc_id']) ) {
        $buildings = host_location_find_connected_buildings_by_ppc_id( get_the_id(), $_GET['location_ppc_id'] );
    } else {
        $buildings = host_location_find_connected_buildings( get_the_id() );
    }
?>
<section id="locations-buildings" class="band band--inset-alt property-list">
    <h2 class="vh">Properties in<br><?=the_title(); ?></h2>

    <?php if ( $buildings->have_posts() ) : ?>
        <?php $counter = 1; ?>
        <ul class="property-list__list">
        <?php while ($buildings->have_posts()): $buildings->the_post(); ?>
            <?php
                // build addresses
                $address = implode("\n", [
                    get_field('building_address_1'),
                    get_field('building_address_2'),
                    get_field('building_address_town_city'),
                    get_field('building_address_post_code'),
                ]);

                // strip unneeded newlines
                $address = trim(preg_replace("/\n\n+/", "\n", $address));
                $phone = trim(get_field('building_address_phone_no'));
                $email = trim(get_field('building_email_address'));

                // thumbnail
                $sPostThumb = '';
                if (has_post_thumbnail()) {
                    $sUrl = wp_get_attachment_image_url(get_post_thumbnail_id(), 'width=500');
                    $sPostThumb = $sUrl;

                }

                // availability stuff
                $aAvailabilityDefinition = RoomsBuildings\availability_status(get_field('availability'));
                $iNumberTypes = get_field('room_types');

                // link stuff
                $bExternal = (get_field('external_website') === true);
                $faqs_url =  get_field('faqs_url');
                $sUrl = $bExternal ? get_field('website_url') : get_the_permalink();
                $sText = $bExternal ? 'Take me to the website' : 'Show me this property';
                $sAtts = $bExternal ? ' target="_blank" rel="noopener noreferrer"' : '';
                $sBtnText = ($aAvailabilityDefinition['text'] === 'Coming soon') ? '' : $sText;

                $favouriteable = ( $aAvailabilityDefinition['text'] != 'Coming soon' ? 'data-favouritable="' . get_the_id() . '"' : null );

                $property_title = get_field('title_1');
            ?>
            <li id="property-<?= esc_attr($counter); ?>" class="property-list__item">
                <article class="listed-property grid">
                    <div class="listed-property__main gc l1-2 xl2-3 xxl5-7 box box--fg-<?=$aAvailabilityDefinition['foreground']; ?> box--padded" <?php echo $favouriteable; ?>>
                        <div class="listed-property__content grid">
                            <div class="listed-property__title-desc gc xxl3-5">
                                <header class="listed-property__header">
                                    <h3 class="listed-property__title plain">
                                        <?php if (!empty($sUrl)): ?>
                                        <a href="<?=$sUrl;?>"<?=$sAtts; ?>>
                                        <?php endif; ?>
                                        <?=$property_title;?>
                                        <?php if (!empty($sUrl)): ?></a><?php endif; ?>
                                    </h3>
                                    <h4 class="listed-property__availability listed-property__availability--<?=$aAvailabilityDefinition['foreground']; ?>"><?=$aAvailabilityDefinition['text']; ?></h4>
                                </header>

                                <?php if ($iNumberTypes !== null): ?>
                                <p class="listed-property__number-types inherit-fg">
                                    <?=($iNumberTypes === '0') ? 'No' : $iNumberTypes; ?> room type<?=($iNumberTypes === '1') ? '' : 's'; ?> available.
                                </p>
                                <?php endif; ?>

                                <?=apply_filters('the_content', get_field('description')); ?>
                            </div>
                            <div class="listed-property__address-contact gc xxl2-5">
                                <address class="listed-property__address">
                                    <?php if (!empty($address)): ?>
                                    <p>
                                        <?=Utils\icon('marker', null, 'inherit-fg');?>
                                        <?=str_replace("\n", '<br>', esc_html($address)); ?>
                                    </p>
                                    <?php endif; ?>

                                    <?php if (!empty($phone)): ?>
                                    <p>
                                        <strong>Call:</strong>
                                        <?=esc_html($phone); ?>
                                    </p>
                                    <?php endif; ?>

                                    <?php if (!empty($email)): ?>
                                    <p>
                                        <strong>Email:</strong>
                                        <a href="mailto:<?=esc_html($email); ?>"><?=esc_html($email); ?></a>
                                    </p>
                                    <?php endif; ?>

                                </address>

                                <?php if (!empty($sUrl) && !empty($sBtnText)): ?>
                                <p>
                                    <a href="<?=$sUrl; ?>" class="btn"<?=$sAtts; ?>><?=$sBtnText; ?></a>

                                    <?php if ( $aAvailabilityDefinition['text'] !== 'Sold out' && !$bExternal ): ?>
                                        <?php $booking_url = get_field('booking_url', 'option'); ?>
                                        <a href="<?=$booking_url; ?>" class="btn btn--red listed-property__booking-btn" <?php Extras\link_open_new_tab_attrs(); ?>>Book now</a>
                                    <?php endif; ?>

                                    <?php if ( $aAvailabilityDefinition['text'] === 'Sold out' ): ?>

                                        <?php

                                        // Note the Hall field "value" on the enquiry form must match
                                        // this value exactly otherwise it won't work
                                        $enquiry_hall_field_ref = "$location_title $property_title";

                                        $enquiry_query_data = array(
                                            'enquiry-type'=> WAITING_LIST_FIELD,
                                            'enquiry-hall'=> $enquiry_hall_field_ref
                                        );

                                        ?>
                                        <a href="/contact/?<?php echo esc_attr( http_build_query($enquiry_query_data) );?>#contact-form-section" class="btn btn--sky btn--block">
                                            Join the Waiting List
                                        </a>
                                    <?php endif; ?>


                                    <?php if (!empty($faqs_url)): ?>
                                        <a href="<?php echo esc_attr( $faqs_url );?>" class="btn btn--red btn--block">
                                            View FAQs
                                        </a>
                                    <?php endif ?>

                                </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                     ?>
                    <aside class="listed-property__image gc l1-2 xl1-3 xxl2-7 lazyload" data-bg="<?php echo esc_attr($sPostThumb);?>">
                        <p class="listed-property__price box box--ink box--fg-<?=$aAvailabilityDefinition['foreground']; ?> h3">
                            Rooms from <span class="inherit-fg"><?=esc_html(get_field('prices_from')); ?></span>
                        </p>
                    </aside>
                </article>
            </li>
            <?php $counter++; ?>
        <?php endwhile; ?>
        </ul>
    <?php else : ?>
        <p>Sorry there are no buildings for this location</p>
    <?php endif; ?>
</section>
<?php
    wp_reset_postdata();
