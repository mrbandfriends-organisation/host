<?php
    /**
     * LOCATION BUILDINGS
     **/
    use Roots\Sage\Utils;
    use Roots\Sage\RoomsBuildings;

    $post_id                       = get_the_id();
    $connected_location            = host_building_find_connected_location( $post_id );
    $connected_location_id         = $connected_location->post->ID;
    $location_conncected_buildings = host_locations_find_connected_building($connected_location_id);

    $main_snippet                  = "building/connected-building-main";
    $secondary_snippet             = "building/connected-building-aside";
?>

<?php
// $main_content = Utils\ob_load_template_part('templates/snippets/' . $main_snippet, array(
    // 'location_id' => $connected_location_id,
// )); ?>


<?php foreach ($location_conncected_buildings->posts as $building) {
    $id = $building->ID;

    $main_content = Utils\ob_load_template_part('templates/snippets/' . $main_snippet, array(
        'location_id' => $connected_location_id,
        'building_id' => $id
    ));

    // image
    //$sStyle = '';
    if ( has_post_thumbnail($id) ) {
        $image   = wp_get_attachment_image_url(get_post_thumbnail_id($id), 'width=500');
        //$sStyle = sprintf(' style="background-image: url(%s)"', $sUrl);
    } else {
        $location_gallery       = get_field('carousel_images', $connected_location_id);
        $image = $location_gallery[0]['url'];
    }

    $title = get_the_title($id);
    $url   = get_the_permalink($id);

    // build addresses
    $address = join("\n", [
        get_field('building_address_1', $id),
        get_field('building_address_2', $id),
        get_field('building_address_town_city', $id),
        get_field('building_address_post_code', $id)
    ]);

    // strip unneeded newlines
    $address = trim(preg_replace("/\n\n+/", "\n", $address));

    $secondary_content = Utils\ob_load_template_part('templates/snippets/' . $secondary_snippet, array(
        'title'   => $title,
        'image'   => $image,
        'url'     => $url,
        'address' => $address
    ));

    echo Utils\ob_load_template_part('templates/components/split-feature', array(
        'color'   => "sky",
        'content' => $main_content,
        'second'  => $secondary_content
    ));
} ?>
