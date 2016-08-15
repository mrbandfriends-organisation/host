<?php

/**
 * POST CONNECTIONS.
 *
 * Registers connections between post types using Posts 2 Posts
 * https://github.com/scribu/wp-posts-to-posts/
 */

namespace HostPluginNamespace\App\Rooms;

class Post_Connections
{
    /**
     * Creates a new instances of the Plugin Class.
     */
    public static function init()
    {
        $self = new self();
        $self->start();
    }

    /**
     * Coordinates initialisation of Plugin.
     */
    private function start()
    {
        add_action('p2p_init', array($this, 'register_post_connections'));
    }

    /**
     * Register Post Type Connections.
     */
    public static function register_post_connections()
    {

        // EXAMPLE p2p connection
        // https://github.com/scribu/wp-posts-to-posts/wiki/p2p_register_connection_type
        p2p_register_connection_type( array(
            'name' => 'room_to_building',
            'from' => 'rooms',
            'to' => 'buildings',
            'cardinality' => 'many-to-one'
        ) );
    }
}
