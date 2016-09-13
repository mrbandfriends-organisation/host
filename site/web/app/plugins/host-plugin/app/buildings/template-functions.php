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
