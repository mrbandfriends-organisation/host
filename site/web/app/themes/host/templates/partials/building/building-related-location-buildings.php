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

    var_dump( $location_conncected_buildings );
?>
