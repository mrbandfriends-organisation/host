<?php
/**
 * UNIVERSITIES TEMPLATE HELPERS.
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
function host_location_find_connected_buildings( $location_id ) {
	$repo = Repo::init();
	$location_buildings = $repo->find_connected('building_to_location', $location_id, array(
	));
  return( $location_buildings );
}


function host_building_find_connected_location( $building_id ) {
	$repo = Repo::init();
	return $repo->find_connected('building_to_location', $building_id, array(
	));
}



/**
 * FIND ALL
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
        $building_links[] = $connected_building->guid;
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
