<?php

/**
 * PLUGIN CORE
 *
 * Plugin base file. Controls initialisation of Plugin.
 *
 */

namespace HostPluginNamespace;

use HostPluginNamespace\Lib;

class Core {

    /**
     * UNIQUE SLUG FOR PLUGIN IDENTIFICATION
     * @var string
     */
	protected static $plugin_slug = 'host_plugin_slug';

    
    /**
     * CONSTRUCTOR
     *
     * Note: The job of the constructor is to create the initial 
     * state of a new object. WordPress hooks have nothing to do 
     * with setting up an initial internal state of an object.
     * So don't put them here.
     */
    function __construct() {
        
    }

    /**
     * CREATES A NEW INSTANCES OF THE PLUGIN CLASS
     */
    public static function init() {
        $self = new self();
        $self->start();
    }


    /**
     * COORDINATES INITIALISATION OF PLUGIN
     */
    private function start() {

        // Reguster Post Types
        $this->register_post_types();

        // Register Post Connections (if required)
        // $this->register_post_connections();
        
        // Initialise Repositories to interact with WP Query
        $this->init_repos();
        
        // Register Filters and Actions
        $this->register_filters();
        $this->register_actions();

   }   

    /**
    * REGISTERS POST TYPES
    */
    private function register_post_types() {
        Lib\Post_Types::init();
    }

    /**
    * REGISTERS POST CONNECTIONS
    */
    private function register_post_connections() {
        Lib\Post_Connections::init();
    }

    /**
    * INITIALISES REPOS
    */
    private function init_repos() {
        Repos\Example::init();
    }

    /**
    * REGISTERS ACTION HOOKS
    *
    * should only be used for global actions. Ideally create container
    * classes for specific actions within the /lib/ directory.
    */
    private function register_actions() {
        //add_action( 'ACTION_NAME', array( $this, 'CALLBACK_FUNCTION' ) );  
    }

    /**
    * REGISTERS FILTERS
    * 
    * should only be used for global actions. Ideally create container
    * classes for specific actions within the /lib/ directory.
    */
    private function register_filters() {
         //add_filter( 'FILTER_NAME', array( $this, 'CALLBACK_FUNCTION' ) );         
    }

    private static function activate() {
        // N/A: Define activation functionality here
    }

    private static function deactivate() {
        // N/A: Define deactivation functionality here
    }

    public function load_plugin_textdomain() {

        $domain = $this->plugin_slug;
        $locale = apply_filters( 'plugin_locale', get_locale(), $domain );

        load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
        load_plugin_textdomain( $domain, FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );

    }

}
