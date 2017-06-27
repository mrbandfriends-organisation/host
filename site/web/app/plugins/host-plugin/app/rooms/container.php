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
        add_action( 'template_redirect', array($this, 'custom_download_retrieval' ) );
        add_action( 'init', array( $this, 'rewrite_rules' ), 10, 0);
        //add_action( 'ACTION_NAME', array( $this, 'CALLBACK_FUNCTION' ) );
        //
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

        add_filter('generate_rewrite_rules', array( $this, 'generate_rewrite_rules' ), 10 );

        add_filter('wp_unique_post_slug', array( $this, 'allow_duplicate_slugs' ), 10, 6 );

        add_action( 'post_updated', array( $this, 'flush_room_rewrite_rules' ), 10, 3 );
        
        
    }


    // public function flush_rules() {

    // }


    public function flush_room_rewrite_rules( $post_id, $post, $update ) {


        $post_type = get_post_type($post_id);
        

        if ($post_type === 'rooms') { // if a Room post is saved we need to flush rewrite rules to regenerate all combos
           // add_action( 'admin_init', array( $this, 'flush_rules' ) );
           flush_rewrite_rules( false );
        } 
        
    }


    public function allow_duplicate_slugs($slug, $post_id, $post_status, $post_type, $post_parent, $original_slug) {
        if ($post_type === "rooms") { // for Rooms allow duplicate slugs as we will generate rewrite rules for all combos
            return $original_slug;
        }    

        return $slug;           
    }


    public function generate_rewrite_rules($wp_rewrite) {

        $rules = [];

        // Get all the Rooms
        $all_rooms_query = host_rooms_find_all();
        $all_rooms = $all_rooms_query->posts; // we need the array of Posts

        // Convert to array of post_slugs
        $room_slugs = array_map(function($room) {
            return $room->post_name;
        }, $all_rooms);

        // Count the name of times each one occurs
        $room_slug_occurances = array_count_values($room_slugs);

        // Filter to get only Posts with duplicate slugs
        $rooms_with_duplicate_slugs = array_filter($all_rooms, function($room) use ($room_slug_occurances) {
            return ( $room_slug_occurances[$room->post_name] > 1 );
        });

        // We need disambiguate the Rooms with duplicate slugs so WP knows how to interpret the url
        // Get the Location and Building slug and create a rewrite rule in the format:
        // /location/{{location_slug}}/{{building_slug}}/{{room_slug}}
        // Then set that to resolve to a "ugly" rewrite passin the post_type and the known post ID
        // the result is that we have "hard coded" rewrite rules in place for all posts where
        // we know we have duplicate slugs
        foreach ($rooms_with_duplicate_slugs as $room) {
            
            $connected_building = host_room_find_connected_building($room->ID);
            
            if ( !empty( $connected_building->post ) ) {
                $building_id    = $connected_building->post->ID;
                $building_slug  = $connected_building->post->post_name;

                $connected_location = host_building_find_connected_location($building_id);

                $location_slug = $connected_location->post->post_name;

                $rules['locations/' . $location_slug . '/' . $building_slug . '/' . $room->post_name . '/?'] = 'index.php?post_type=rooms&p=' . $room->ID;
            }             
        }

        // merge with global rules
        // with custom rules LAST so that normal rules overtake them
        // otherwise it does not work as you would expect/want
        $wp_rewrite->rules = $rules + $wp_rewrite->rules;
    }


    /**
     * CUSTOM DOWNLOAD RETRIEVAL
     * 
     * client requirement was to have documents relating to a room accessible
     * at a custom url end point in the format:
     *
     * /locations/{{city}}/{{building}}/documents/{{document-slug}}/ 
     */
    public function custom_download_retrieval() {
        
        // Custom query vars set in rewrite rules
        $custom_attachment_type     = get_query_var('custom_attachment_type'); // "room"
        $custom_attachment_name     = get_query_var('custom_attachment_name'); // the "name" field of the attachement

        // Only handle if required query vars are present
        if ( !empty($custom_attachment_name) && !empty($custom_attachment_type) && $custom_attachment_type === "room") {

            // Retrieve Attachment posts by "name" (which is like post_name)
            $attachment_query = new \WP_Query(array(
                'post_type'=> 'attachment',
                //'attachment_id' => 3734
                'attachment' => $custom_attachment_name
                //'post_mime_type' => 'application/pdf'    
            ));

            // If we have a matching attachement then proceed to download
            if ( !empty($attachment_query->post) ) {
                
                // Get file path and derive file name
                $file_path      = get_attached_file($attachment_query->post->ID);
                $file_name      = basename( $file_path );
               
                // Force file to download
                header('X-Robots-Tag: noindex');
                header('Pragma: public');   // required
                header('Expires: 0');       // no cache
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                header('Last-Modified: '.gmdate ('D, d M Y H:i:s', filemtime ($file_path)).' GMT');
                header('Cache-Control: private',false);
                header('Content-Type: application/pdf');
                header('Content-Disposition: attachment; filename="' . $file_name . '"');
                header('Content-Transfer-Encoding: binary');
                header('Content-Length: ' . filesize($file_path));    // provide file size
                header('Connection: close');
                readfile($file_path);       // push it out
                wp_die();
            }
        }
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

        // Rules for handling attachments on this room 
        add_rewrite_tag('%custom_attachment_type%', '([A-Za-z]+)');  
        //add_rewrite_tag('%custom_attachment_id%', '([0-9]+)');  
        add_rewrite_tag('%custom_attachment_name%', '([0-9A-Za-z-_.]+)');  
         
        
        // Specific requests for Room file attachments
        // eg: /locations/bristol/king-square-studios/documents/3735-pdf-sample/
        add_rewrite_rule('locations/[0-9A-Za-z-]+/[0-9A-Za-z-]+/documents/([0-9A-Za-z-_.]+)/?', 'index.php?custom_attachment_name=$matches[1]&custom_attachment_type=room', 'top');
        
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




    // public function modify_attachment_link( $markup, $id, $size, $permalink, $icon, $text ) {
    //     return $markup;
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
