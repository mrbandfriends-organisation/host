<?php
/**
 * ROOMS TEMPLATE HELPERS.
 *
 * template helper functions to allow WordPress templates
 * to access Examples data
 */
use HostPluginNamespace\App\Rooms\Repos\Rooms as Repo;

/**
 * FIND ALL
 * returns all records from Repo.
 */
function host_rooms_find_all()
{
    $repo = Repo::init();

    return $repo->find_all();
}

function host_room_find_connected_building( $room_id ) {
	$repo = Repo::init();
	return $repo->find_connected('room_to_building', $room_id);
}
