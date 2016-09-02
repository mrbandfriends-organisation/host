<?php

namespace Roots\Sage\RoomsBuildings;
use Roots\Sage\Setup;

/**
 * Makes Building and Room availability friendly
**/
function availability_status($availability) {

    switch ($availability) {
        case "available":
            echo "Rooms available";
            break;
        case "limited":
            echo "Limited availability";
            break;
        case "sold_out":
            echo "Sold out";
            break;
        default:
            echo "Available";
    }

}

?>
