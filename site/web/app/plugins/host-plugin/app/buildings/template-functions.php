<?php
/**
 * BUILDINGS TEMPLATE HELPERS.
 *
 * template helper functions to allow WordPress templates
 * to access Examples data
 */
use HostPluginNamespace\App\Buildings\Repos\Buildings as Repo;

/**
 * FIND ALL
 * returns all records from Repo.
 */
function host_buildings_find_all() {
    $repo = Repo::init();

    return $repo->find_all();
}

function host_buildings_find_connected_rooms( $building_id ) {
	$repo = Repo::init();
	return $repo->find_connected('room_to_building', $building_id, array(
	));
}

/**
 * FIND ALL
 * Connected buildings to location.
 */
function host_location_find_connected_buildings( $location_id, $query_args = [] ) {
	$repo = Repo::init();

	$location_buildings = $repo->find_connected(
        'building_to_location',
        $location_id,
        $query_args
    );

    return( $location_buildings );
}


/**
 *  Get posts with locations for map markers
 *
 * @param [int]     $location_id [ID of location post]
 * @param [string]  $ppc_id      [PPC id]
 *
 * @return [array]               [WP_Query array]
 *
 */
function host_location_find_connected_buildings_by_ppc_id($location_id, $ppc_id) {

    $locationPPI = [
        'meta_key'	 => 'location_ppc_id',
        'meta_value' => $ppc_id
    ];

    return host_location_find_connected_buildings($location_id, $locationPPI);
}


/**
 * FIND
 * Connected buildings to location that are NOT external websites.
 */
function host_building_find_connected_location( $building_id ) {
	$repo = Repo::init();
	return $repo->find_connected('building_to_location', $building_id, array(
	));
}



/**
 * FIND
 * Connected buildings to location that are NOT external websites.
 */
function host_location_find_internal_connected_buildings( $location_id ) {
	$repo = Repo::init();
	$location_buildings = $repo->find_connected('building_to_location', $location_id, array(
	));

  $connected_buildings_array = $location_buildings->posts;

  $building_links = array();

  foreach ($connected_buildings_array as $index => $connected_building) {

    $external = get_field('external_website', $connected_building->ID);
    if ( $external != "" ) {
      $external = $external[0];
    }

    if ($external == "0") {
        $building_links[] = $connected_building->ID;
    }
    else {
        // Do not return anything for external sites
    }

  }

  if ( !empty($building_links) ) {
    $random_building_link = array_rand($building_links);
    $building_link_key = $random_building_link;

    return $building_links[$building_link_key];
  }


}
