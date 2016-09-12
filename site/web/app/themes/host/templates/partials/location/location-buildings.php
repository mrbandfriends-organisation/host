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

            // thumbnail
            $sStyle = '';
            if (has_post_thumbnail())
            {
                $sUrl   = wp_get_attachment_image_url(get_post_thumbnail_id(), 'width=360');
                $sStyle = sprintf(' style="background-image: url(%s)"', $sUrl);
            }
        ?>
        <li class="property-list__item">
            <article class="listed-property grid">
                <div class="listed-property__main gc l1-2 xl2-3 box box--fg-sky box--padded">
                    <div class="listed-property__content grid">
                        <div class="listed-property__title-desc gc xxl3-5">
                            <h3 class="listed-property__title"><?=the_title(); ?></h3>
                            <h4 class="h3"><?php RoomsBuildings\availability_status(get_field('availability')); ?></h4>

                            <?=get_field('description'); ?>
                        </div>
                        <div class="listed-property__address-contact gc xxl2-5">
                            <address class="listed-property__address">
                                <?php if (!empty($address)): ?>
                                <p>
                                    <?=Utils\icon('marker', null, 'inherit-fg');?>
                                    <?=str_replace("\n", '<br>', esc_html($address)); ?>
                                </p>
                                <?php endif; ?>
                                <p>
                                    <strong>Call:</strong>
                                    <?=esc_html(get_field('building_address_phone_no')); ?>
                                </p>
                            </address>
                            <p>
                                <a href="<?=get_the_permalink(); ?>" class="btn">Show me this website</a>
                            </p>
                        </div>
                    </div>
                </div>
                <aside class="listed-property__image gc l1-2 xl1-3"<?=$sStyle; ?>>
                    <p class="listed-property__price box box--ink box--less-padding h3">
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
