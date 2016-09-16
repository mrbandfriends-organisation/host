<?php
    /**
     * LOCATION BUILDINGS
     **/
    use Roots\Sage\Utils;
    use Roots\Sage\RoomsBuildings;

    $id                            = get_the_id();
    $connected_location            = host_building_find_connected_location( $id );
    $connected_location_id         = $connected_location->post->ID;
    $location_conncected_buildings = host_locations_find_connected_building($connected_location_id);

    $snippet                       = "building/connected-building";
?>

<h2>
    <?php echo get_the_title($connected_location_id); ?>
</h2>
<?php
    $location_link          = get_the_permalink($connected_location_id);
?>
<a href="<?php echo esc_url($location_link); ?>" class="btn">Look at this location</a>


<?php if ( $location_conncected_buildings->have_posts() ) : ?>
    <?php while ( $location_conncected_buildings->have_posts() ) : $location_conncected_buildings->the_post(); ?>
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

        <?php $second = Utils\ob_load_template_part('templates/snippets/' . $snippet, array(
            'title'   => $title,
            'image'   => $image,
            'url'     => $url,
            'address' => $address
        ));
        ?>
    <?php endwhile; ?>
<?php endif; ?>
<?php wp_reset_postdata(); ?>

<?php
    echo Utils\ob_load_template_part('templates/components/split-feature', array(
    'color'   => "sky",
    //'content' => $main_content
    'second' => $second
));
?>
