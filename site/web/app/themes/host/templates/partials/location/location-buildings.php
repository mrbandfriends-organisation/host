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
    if( isset($_GET['location_id']) ) {
        $buildings = host_location_find_connected_buildings_by_ppc_id( get_the_id(), $_GET['location_id'] );
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

                $building_id = get_the_id();

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
                $availability_status = RoomsBuildings\building_availability( $building_id );
                $iNumberTypes = get_field('room_types');

                // link stuff
                $bExternal  = (get_field('external_website') === true);
                $faqs_url   =  get_field('faqs_url');
                $sUrl       = $bExternal ? get_field('website_url') : get_the_permalink();
                $sText      = $bExternal ? 'Take me to the website' : 'Show me this property';
                $sAtts      = $bExternal ? ' target="_blank" rel="noopener noreferrer"' : '';
                $sBtnText   = ($availability_status['text'] === 'Coming soon') ? '' : $sText;

                $favouriteable = ( $availability_status['favouritable'] ? 'data-favouritable="' . get_the_id() . '"' : null );

                $building_title  = get_the_title(); // the actual Building "post" title
                $property_title  = get_field('title_1'); // a presentation version of the title
            ?>
            <li id="property-<?= esc_attr($counter); ?>" class="property-list__item">
                <article class="listed-property grid">
                    <div class="listed-property__main gc l1-2 xl2-3 xxl5-7 box box--fg-<?=$availability_status['foreground']; ?> box--padded" <?php echo $favouriteable; ?>>
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
                                    <h4 class="listed-property__availability listed-property__availability--<?=$availability_status['foreground']; ?>"><?=$availability_status['text']; ?></h4>
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
                                
                                <p>
                                    <?php if ($bExternal && !empty($faqs_url)): ?>
                                    <a href="<?=$faqs_url; ?>" class="btn btn--block"><?=get_the_title();?> FAQs</a>
                                    <?php endif; ?>

                                    <?php if (!empty($sUrl) && !empty($sBtnText)): ?>
                                    <a href="<?=$sUrl; ?>" class="btn"<?=$sAtts; ?>><?=$sBtnText; ?></a>
                                    <?php endif; ?>
                                    
                                    <?php echo Utils\ob_load_template_part('templates/snippets/building/conditional-buttons', array(
                                        'can_book' => $availability_status['can_book'],
                                        'can_join_waiting_list' => $availability_status['can_join_waiting_list'],
                                        'enquiry_hall_name' => $location_title . " " . $building_title,
                                        'btn_modifiers' => 'btn--block'
                                    )); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php
                     ?>
                    <aside class="listed-property__image gc l1-2 xl1-3 xxl2-7 lazyload" data-bg="<?php echo esc_attr($sPostThumb);?>">
                        <p class="listed-property__price box box--ink box--fg-<?=$availability_status['foreground']; ?> h3">
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
