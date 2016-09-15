<?php
    /**
     * LOCATION BUILDINGS
     **/
    use Roots\Sage\Utils;
    use Roots\Sage\RoomsBuildings;

    // get buildings
    $buildings = new WP_Query([
        'connected_type'  => 'building_to_location',
        'connected_items' => get_queried_object(),
        'nopaging'        => true
    ]);

    // if nothing, bail
    if ( !$buildings->have_posts() )
    {
        return;
    }
?>
<section class="band band--inset-alt property-list">
    <h2 class="vh">Properties in<br><?=the_title(); ?></h2>

    <ul class="property-list__list">
    <?php while ( $buildings->have_posts() ): $buildings->the_post(); ?>
        <?php
            // build addresses
            $address = join("\n", [
                get_field('building_address_1'),
                get_field('building_address_2'),
                get_field('building_address_town_city'),
                get_field('building_address_post_code')
            ]);

            // strip unneeded newlines
            $address = trim(preg_replace("/\n\n+/", "\n", $address));
            $phone   = trim(get_field('building_address_phone_no'));

            // thumbnail
            $sStyle = '';
            if (has_post_thumbnail())
            {
                $sUrl   = wp_get_attachment_image_url(get_post_thumbnail_id(), 'width=500');
                $sStyle = sprintf(' style="background-image: url(%s)"', $sUrl);
            }

            // availability stuff
            $aAvailabilityDefinition = RoomsBuildings\availability_status(get_field('availability'));

            $iNumberTypes = get_field('room_types');
        ?>
        <li class="property-list__item">
            <article class="listed-property grid">
                <div class="listed-property__main gc l1-2 xl2-3 box box--fg-<?=$aAvailabilityDefinition['foreground']; ?> box--padded">
                    <div class="listed-property__content grid">
                        <div class="listed-property__title-desc gc xxl3-5">
                            <h3 class="listed-property__title plain"><?=get_field('title_1'); ?></h3>
                            <h4 class="listed-property__availability"><?=$aAvailabilityDefinition['text']; ?></h4>

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
                            </address>

                            <?php if (get_field('external_website')): ?>
                            <p>
                                <a href="<?=get_field('website_url'); ?>" class="btn" target="_blank" rel="noopener noreferrer">Take me to the website</a>
                            </p>
                            <?php else: ?>
                            <p>
                                <a href="<?=get_the_permalink(); ?>" class="btn">Show me this property</a>
                            </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <aside class="listed-property__image gc l1-2 xl1-3"<?=$sStyle; ?>>
                    <p class="listed-property__price box box--ink box--less-padding box--fg-<?=$aAvailabilityDefinition['foreground']; ?> h3">
                        Rooms from <span class="inherit-fg"><?=esc_html(get_field('prices_from')); ?></span>
                    </p>
                </aside>
            </article>
        </li>
    <?php endwhile; ?>
    </ul>
</section>
<?php
    wp_reset_postdata();
