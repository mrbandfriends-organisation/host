<?php
    Use Roots\Sage\Extras;

    $building_name  = ( get_the_title() );
    $address_1      = ( !empty( get_field('building_address_1') ) ? get_field('building_address_1') : null );
    $town           = ( !empty( get_field('building_address_town_city') ) ? get_field('building_address_town_city') . ', ' : null );
    $post_code      = ( !empty( get_field('building_address_post_code') ) ? get_field('building_address_post_code') : null );
    $phone          = ( !empty( get_field('building_address_phone_no') ) ?  get_field('building_address_phone_no')  : null );

    $address = join("\n", [
        $address_1,
        $town . $post_code
    ]);
    // strip unneeded newlines
    $address = trim(preg_replace("/\n\n+/", "\n", $address));

    // Address for the link to Google Maps
    $google_maps_address = join( [
        $address_1,
        $town,
        $post_code
    ]);
    $google_maps_address = str_replace(" ", '+', esc_html($address));
?>

<?php if ( !empty($building_name) ): ?>
    <h3 class="carousel-infobox__heading">
        <?php echo esc_html($building_name); ?> building.
        <br>
        London.
    </h3>
<?php endif; ?>

<?php if ( !empty($address) ): ?>
    <strong class="carousel-infobox__subheading">Address.</strong>
    <p>
        <?=str_replace("\n", '<br>', esc_html($address)); ?>
    </p>

    <?php // Taking off to google maps with address as destination ?>
    <strong class="carousel-infobox__subheading">
        <a class="carousel-infobox__underlink-link" href="https://www.google.com/maps?daddr=<?= $google_maps_address ?>); ?>" <?php Extras\link_open_new_tab_attrs(); ?>>
            Get directions
        </a>
    </strong>
<?php endif; ?>

<?php if ( !empty($phone) ): ?>
    <strong class="carousel-infobox__subheading">Call.</strong>
    <span><?php echo esc_html($phone); ?></span>
<?php endif; ?>
