<?php if ( $location_connected_buildings->have_posts() ) : ?>
    <?php while ( $location_connected_buildings->have_posts() ) : $location_connected_buildings->the_post(); ?>
        <?php
            // image
            //$sStyle = '';
            if ( has_post_thumbnail() ) {
                $image   = wp_get_attachment_image_url(get_post_thumbnail_id(), 'width=500');
                //$sStyle = sprintf(' style="background-image: url(%s)"', $sUrl);
            } else {
                $location_gallery       = get_field('carousel_images', $connected_location_id);
                $image = $location_gallery[0]['url'];
            }

            $title = get_the_title();
            $url   = get_the_permalink();

            // build addresses
            $address = join("\n", [
                get_field('building_address_1'),
                get_field('building_address_2'),
                get_field('building_address_town_city'),
                get_field('building_address_post_code')
            ]);

            // strip unneeded newlines
            $address = trim(preg_replace("/\n\n+/", "\n", $address));
        ?>
    <?php endwhile; ?>
<?php endif; ?>
<?php if ( $location_connected_buildings->have_posts() ) : ?>
    <?php while ( $location_connected_buildings->have_posts() ) : $location_connected_buildings->the_post(); ?>
        <?php
            // image
            //$sStyle = '';
            if ( has_post_thumbnail() ) {
                $image   = wp_get_attachment_image_url(get_post_thumbnail_id(), 'width=500');
                //$sStyle = sprintf(' style="background-image: url(%s)"', $sUrl);
            } else {
                $location_gallery       = get_field('carousel_images', $connected_location_id);
                $image = $location_gallery[0]['url'];
            }

            $title = get_the_title();
            $url   = get_the_permalink();

            // build addresses
            $address = join("\n", [
                get_field('building_address_1'),
                get_field('building_address_2'),
                get_field('building_address_town_city'),
                get_field('building_address_post_code')
            ]);

            // strip unneeded newlines
            $address = trim(preg_replace("/\n\n+/", "\n", $address));
        ?>
    <?php endwhile; ?>
<?php endif; ?>
<?php if ( $location_connected_buildings->have_posts() ) : ?>
    <?php while ( $location_connected_buildings->have_posts() ) : $location_connected_buildings->the_post(); ?>
        <?php
            // image
            //$sStyle = '';
            if ( has_post_thumbnail() ) {
                $image   = wp_get_attachment_image_url(get_post_thumbnail_id(), 'width=500');
                //$sStyle = sprintf(' style="background-image: url(%s)"', $sUrl);
            } else {
                $location_gallery       = get_field('carousel_images', $connected_location_id);
                $image = $location_gallery[0]['url'];
            }

            $title = get_the_title();
            $url   = get_the_permalink();

            // build addresses
            $address = join("\n", [
                get_field('building_address_1'),
                get_field('building_address_2'),
                get_field('building_address_town_city'),
                get_field('building_address_post_code')
            ]);

            // strip unneeded newlines
            $address = trim(preg_replace("/\n\n+/", "\n", $address));
        ?>
    <?php endwhile; ?>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
