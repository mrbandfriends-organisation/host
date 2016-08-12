<?php
/**
 * UNIVERSITIES CONTAINER.
 *
 * container Class for "Examples" functionality
 */

namespace HostPluginNamespace\App\Universities;

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
        Repos\Universities::init();
    }

    /**
     * REGISTERS ACTION HOOKS.
     *
     * should only be used for global actions. Ideally create container
     * classes for specific actions within the /lib/ directory.
     */
    private function register_actions()
    {
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
        //add_filter( 'FILTER_NAME', array( $this, 'CALLBACK_FUNCTION' ) );
    }
}

// Template functions
require_once __DIR__.'/template-functions.php';
