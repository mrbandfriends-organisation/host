<?php
/**
 * ROOMS CONTAINER.
 *
 * container Class for "Examples" functionality
 */

namespace HostPluginNamespace\App\Rooms;

use HostPluginNamespace\Lib;
use HostPluginNamespace\App\Buildings\Repos\Buildings as BuildingsRepo;

class container
{
    /**
     * CONSTRUCTOR.
     *
     * Note: The job of the constructor is to create the initial
     * state of a new object. WordPress hooks have nothing to do
     * with setting up an initial internal state of an object.
     * So don't put them here.
     */
    public function __construct()
    {
    }

    /**
     * CREATES A NEW INSTANCES OF THE PLUGIN CLASS.
     */
    public static function init()
    {
        $self = new self();
        $self->start();
    }

    /**
     * COORDINATES INITIALISATION OF PLUGIN.
     */
    private function start()
    {

        // Reguster Post Types
        $this->register_post_types();

        // Register Post Connections (if required)
        $this->register_post_connections();

        // Initialise Repositories to interact with WP Query
        $this->init_repos();

        // Register Filters and Actions
        $this->register_filters();
        $this->register_actions();
    }

    /**
     * REGISTERS POST TYPES.
     */
    private function register_post_types()
    {
        Post_Types::init();
    }

    /**
     * REGISTERS POST CONNECTIONS.
     */
    private function register_post_connections()
    {
        Post_Connections::init();
    }

    /**
     * INITIALISES REPOS.
     */
    private function init_repos()
    {
        Repos\Rooms::init();
    }

    /**
     * REGISTERS ACTION HOOKS.
     *
     * should only be used for global actions. Ideally create container
     * classes for specific actions within the /lib/ directory.
     */
    private function register_actions()
    {
        add_action( 'init', array( $this, 'rewrite_rules' ), 10, 0);
        //add_action( 'ACTION_NAME', array( $this, 'CALLBACK_FUNCTION' ) );
    }

    /**
     * REGISTERS FILTERS.
     *
     * should only be used for global actions. Ideally create container
     * classes for specific actions within the /lib/ directory.
     */
    private function register_filters()
    {   
        add_filter( 'post_type_link', array( $this, 'modify_post_type_link' ), 10, 2 );

        add_filter( 'breadcrumb_trail_items', array( $this, 'modify_breadcrumb_items' ), 10, 2 );

        //add_filter( 'wp_get_attachment_link', array( $this, 'modify_attachment_link' ), 10, 5 );


      
    }


    /**
     * REWRITE RULES
     * 
     * creates custom permalink structures. The key is mapping the custom url structure to the 
     * default query args generated when registering the post_type. To check what the non-pretty 
     * url args are, simply disable pretty permalinks from within the admin and then copy the values
     * in the url. 
     *
     * Note: the order in which add_rewrite_rule() is called in this method is CRIITCAL in order to ensure
     * the rewrite rules are matched in order of specificity
     */
    public function rewrite_rules() 
    {
        // Add our two rewrite tags for use in the rewrite rules
        add_rewrite_tag('%room_name%', '([0-9A-Za-z]+)', 'rooms=');
        add_rewrite_tag('%building_name%', '([0-9A-Za-z]+)', 'buildings=');      
        
        // Single ROOM - the most specific rule **must** be first...
        add_rewrite_rule('locations/[0-9A-Za-z-]+/[0-9A-Za-z-]+/([0-9A-Za-z-]+)/?', 'index.php?rooms=$matches[1]', 'top');

        // Single BUILDING - less specific rules last
        add_rewrite_rule('locations/[0-9A-Za-z-]+/([0-9A-Za-z-]+)/?', 'index.php?buildings=$matches[1]', 'top');
    }


    /**
     * MODIFY BREADCRUMB ITEMS
     *
     * modifies the default breadcrumbs so that they match the new url
     * structure and reflect the relationships between the Room, the Building
     * and the Location. 
     */
    public function modify_breadcrumb_items($items, $args) 
    {
        global $post; // current post

        if( !empty($post) && 'rooms' == $post->post_type ) { // only do this when necessary
            $connected = $this->get_connected_location_and_building($post->ID);

            if (!empty($connected)) {
        
                $building_id    = $connected->building->ID;
                $building_title = $connected->building->post_title;
                $building_slug  = '<a href="' . get_the_permalink($building_id) . '">' . $building_title . '</a>';


                $location_id    = $connected->location->ID;
                $location_title = $connected->location->post_title;
                $location_slug  = '<a href="' . get_the_permalink($location_id) . '">' . $location_title . '</a>';

                // Insert at correct place in breadcrumbs
                array_splice( $items, -1, 0, $location_slug ); 
                array_splice( $items, -1, 0, $building_slug ); 

            }
        }

        //var_dump($items);

        return $items;
    }




    // public function modify_attachment_link($id, $size, $permalink, $icon, $text) {
    //     var_dump($permalink);
    //     return $foo;
    // }


    /**
     * FILTERS THE PERMALINK
     * 
     * post type links for rooms have placeholder values which needs to be
     * dynamically replaced with the correct values on a per post basis
     *
     * Note the format of the original permalink is defined when you register
     * the post type using the "rewrite" option to define a custom slug which
     * contains placeholder values
     */
    public function modify_post_type_link( $link, $post ) 
    {
          if ( 'rooms' == $post->post_type ) {
            
            $connected = $this->get_connected_location_and_building($post->ID);

            if (!empty($connected)) {
                $building_id    = $connected->building->ID;
                $building_slug  = $connected->building->post_name;
     

                $location_slug  = $connected->location->post_name;


                // Replace placeholders in the permalink
                $link = str_replace( '%location_name%', $location_slug, $link );
                $link = str_replace( '%building_name%', $building_slug, $link );
                $link = str_replace( '%room_name%', 'twodio', $link );            
                # code...
            }
          }
          
          return $link;
    }


    /**
     * GET CONNECTED LOCATION AND BUILDING
     *
     * utility method to return the connected Building (and that
     * building's connected Location) for a given Room.
     */
    private function get_connected_location_and_building($room_id) 
    {
        $rooms_repo     = Repos\Rooms::init();
        $buildings_repo = BuildingsRepo::init();

        $building_from_room = $rooms_repo->find_connected(
            'room_to_building',
            $room_id
        );

        $building       = $building_from_room->post;
        
        if ( !empty( $building ) ) {       
            $building_id    = $building->ID;

            $location_from_building = $buildings_repo->find_connected(
                'building_to_location',
                $building_id
            );

            $location       = $location_from_building->post;

            $rtn = new \stdClass();

            $rtn->building = $building;
            $rtn->location = $location;
        } else {
            $rtn = false;
        }

        return $rtn;
    }
}

// Template functions
require_once __DIR__.'/template-functions.php';
