<?php

namespace Roots\Sage\RoomsBuildings;
use Roots\Sage\Setup;

/**
 * Makes Building and Room availability friendly
**/
function availability_status($availability)
{

    switch ($availability)
    {
        case "limited":
            return [
                'text' => "Limited availability",
                'colour' => 'orange',
                'foreground' => 'orange'
            ];
            break;

        case "sold_out":
            return [
                'text' => "Sold out",
                'colour' => 'red',
                'foreground' => 'red'
            ];
            break;

            case "coming_soon":
                return [
                    'text' => "Coming soon",
                    'colour' => 'orange',
                    'foreground' => 'orange'
                ];
                break;

        default:
            return [
                'text' => "Available",
                'colour' => 'mint',
                'foreground' => 'sky'
            ];
    }

}

/**
 *  BUILDING AVAILIBILITY
 *
 *  Checks building availability. If building is sold out then this
 *  availibity status overrides invidivual rooms status
 */
function building_availability($room_id = null) {

    if( !empty($room_id) ) {

        // 1. Getting connected buildings ID
        $connected_building = host_room_find_connected_building( $room_id );
        $building_id        = $connected_building->posts[0]->ID;

        // 2. Checking buildings status.
        $field                 = get_field( 'availability', $building_id );
        $building_availability = ( !empty($field) ? $field : null );

        // 3. Returns building or rooms status
        if ( !empty($building_availability) && $building_availability === 'sold_out' ) {
            return availability_status('sold_out');
        } else {
            $availability = get_field('availability', $room_id);
            return availability_status($availability);
        }
    }

}

?>
