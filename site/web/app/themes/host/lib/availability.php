<?php

namespace Roots\Sage\RoomsBuildings;
use Roots\Sage\Setup;

/**
 * Makes Building and Room availability friendly
**/
function get_availability_config($availability = "available", $type )
{

    switch ($availability)
    {
        case "limited":
            return [
                'status' => 'limited_availability',
                'type' => $type,
                'text' => "Limited availability",
                'colour' => 'orange',
                'foreground' => 'orange',
                'can_book' => true,
                'can_join_waiting_list' => false
            ];
            break;

        case "sold_out":
            return [
                'status' => 'sold_out',
                'type' => $type,
                'text' => "Sold out",
                'colour' => 'red',
                'foreground' => 'red',
                'can_book' => false,
                'can_join_waiting_list' => true
            ];
            break;

        case "coming_soon":
            return [
                'status' => 'coming_soon',
                'type' => $type,
                'text' => "Coming soon",
                'colour' => 'orange',
                'foreground' => 'orange',
                'can_book' => false,
                'can_join_waiting_list' => true
            ];
            break;

        case "available":
        default:
            return [
                'status' => 'available',
                'type' => $type,
                'text' => "Available",
                'colour' => 'mint',
                'foreground' => 'sky',
                'can_book' => true,
                'can_join_waiting_list' => false
            ];
    }
}


/**
 *  ROOM or BUILDING AVAILIBILITY
 *
 *  Checks against building availability. If building status is set to anything
 *  other than "available" then use the buildings status (overiding any room level
 *  statuses). However if the building is "available" then use the status
 *  set on the room itself. 
 *
 *  Note: to avoid unecessary DB calls, you are expected to query the building's
 *  availability and pass the "status" into this function. This avoids n+1 queries.
 */
function room_building_availability($room_id, $building_status) {
    
    if (!empty($building_status) && $building_status['status'] === "sold_out" ) {
        $availability_status = $building_status;
    } else {
        $availability_status = room_availability( $room_id );
    }

    return $availability_status;
}


function building_availability($building_id) {
    return unit_availability($building_id, "building");
}

function room_availability($room_id) {
    return unit_availability($room_id, "room");
}

function unit_availability($unit_id, $unit_type="") {
   if( !empty($unit_id) ) {       

        // 2. Checking buildings status.
        $availability          = get_field( 'availability', $unit_id );
        
        $unit_availability = ( !empty($availability) ? $availability : null );

        // 3. Returns building or rooms status
        if ( !empty($unit_availability) ) {
            return get_availability_config($unit_availability, $unit_type);
        } else {
            return get_availability_config("available", $unit_type); // default to "available"
        }
    } 
}




?>
