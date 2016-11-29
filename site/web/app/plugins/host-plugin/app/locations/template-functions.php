<?php
/**
 * LOCATIONS TEMPLATE HELPERS.
 *
 * template helper functions to allow WordPress templates
 * to access Examples data
 */
use HostPluginNamespace\App\Locations\Repos\Locations as Repo;

/**
 * FIND ALL
 * returns all records from Repo.
 */
function host_locations_find_all($args = [])
{
    $repo = Repo::init();

    return $repo->find_all($args);
}

function host_locations_find_connected_building( $location_id, $current_id = null ) {
	$repo = Repo::init();
	return $repo->find_connected('building_to_location', $location_id, array(
        'post__not_in' => [$current_id]
	));
}

/**
 *  Get posts with locations for map markers
 *
 * @param array $oConnectedPosts [Array of post objects]
 *
 * @return [array] $aSingleMarker [Array of markers]
 */
// if( isset($_GET['location_ppc_id']) ) {
//
//     $ppc_id = (int)$_GET['location_ppc_id'];
//
//     $locationPPI = [
//         'meta_key'	 => 'location_ppc_id',
//         'meta_value' => $ppc_id
//     ];
//
//     $query = array_merge($query, $locationPPI);
// }
