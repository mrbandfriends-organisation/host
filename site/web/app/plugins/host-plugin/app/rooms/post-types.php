<?php
/**
 * POST TYPES.
 *
 * Registers post types and taxonomies
 */

namespace HostPluginNamespace\App\Rooms;

use CPT as CPT;

class Post_Types
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
        $this->register_post_types();
    }

    /**
     * Register core post types.
     */
    private function register_post_types()
    {

         /*
         * ROOMS
         */
         $rooms = new CPT(
             array(
                 'post_type_name' => 'rooms',
                 'singular' => __( 'Room', 'host'),
                 'plural' => __( 'Rooms', 'host'),
                 //'slug' => __( 'rooms', 'host'),
             ),
             array(
                 'show_in_nav_menus' => true,
                 'hierarchical' => true,
                 'taxonomies' => array(
                   'category'
                 ),
                 'supports' => array(
                     'title',
                     'editor',
                     'thumbnail',
                     'page-attributes'
                 ),
                 'rewrite' => array(
                    'slug' => __( 'locations/%location_name%/%building_name%', 'host'),
                )
             )
         );
         $rooms->menu_icon("dashicons-admin-home");
    }
}
