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

        default:
            return [
                'text' => "Available",
                'colour' => 'mint',
                'foreground' => 'sky'
            ];
    }

}

?>
