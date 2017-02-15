<?php
/**
 * UNIVERSITIES CONTAINER.
 *
 * container Class for "Examples" functionality
 */

namespace HostPluginNamespace\App\Buildings;
use Roots\Sage\RoomsBuildings;

use HostPluginNamespace\Lib;

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
        Repos\Buildings::init();
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

        add_action('wp_ajax_nopriv_buildings_load_favourites', array($this, 'getBuildingInformation'));
        add_action('wp_ajax_buildings_load_favourites',        array($this, 'getBuildingInformation'));
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
    }

    public function modify_post_type_link( $link, $post ) {
          if ( 'buildings' == $post->post_type ) {

            $repo = Repos\Buildings::init();
            $query = $repo->find_connected(
                'building_to_location',
                $post->ID
            );

            $connected_location = $query->post->post_name;
            
            return str_replace( '%location_name%', $connected_location, $link );
            
          }
          return $link;
    }


    public function rewrite_rules() {

        add_rewrite_tag('%building_name%', '([0-9A-Za-z]+)');
        add_rewrite_tag('%location_name%', '([0-9A-Za-z]+)');
       
        add_rewrite_rule('locations/([0-9A-Za-z-]+)/([0-9A-Za-z-]+)/?', 'index.php?buildings=$matches[2]', 'top');

        //buildings=cambridge-cb1

    }


    public function getBuildingInformation()
    {
        // 0. if there’s nothing, bounce
        if (!isset($_GET['id']) || !is_array($_GET['id']))
        {
            return wp_send_json( [] );
        }

        // 1. load buildings
        $oRepo = Repos\Buildings::init();
        $aoBuildings = $oRepo->find_all([ 'post__in' => $_GET['id'] ]);

        // 2. start building an array
        $aoJsonReturn = [];
        while ($aoBuildings->have_posts())
        {
            $aoBuildings->the_post();

            if ($is_external = (get_field('external_website')) === true):
                $return_url = get_field('website_url');
                $return_attrs = 'target="_blank" rel="noopener" rel="noreferrer"';
                $return_message = 'Take me to the website';
            else:
                $return_url = get_the_permalink();
                $return_attrs = '';
                $return_message = 'Show me this property';
            endif;

            // a. basic info
            $aReturn = [
                'id'                => get_the_ID(),
                'title'             => get_the_title(),
                'url'               => $return_url,
                'attrs'             => $return_attrs,
                'btn_message'       => $return_message,
                'availability'      => RoomsBuildings\availability_status(get_field('availability'))
            ];

            // b. acquire a thumbnail
            if (has_post_thumbnail())
            {
                $aReturn['thumbnail'] = wp_get_attachment_image_url(get_post_thumbnail_id(), 'width=150&height=150&crop=true');
            }

            // c. and a city
            $aCity = new \WP_Query([
                'connected_type' => 'building_to_location',
                'connected_from' => get_the_ID()
            ]);
            if ($aCity->post_count > 0)
            {
                $aReturn['city'] = $aCity->posts[0]->post_title;
            }

            // d. truncate
            $aoJsonReturn[] = $aReturn;
        }

        // 3. return
        wp_send_json($aoJsonReturn);
    }
}

// Template functions
require_once __DIR__.'/template-functions.php';
