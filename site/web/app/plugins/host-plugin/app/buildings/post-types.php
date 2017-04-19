<?php
/**
 * POST TYPES.
 *
 * Registers post types and taxonomies
 */

namespace HostPluginNamespace\App\Buildings;

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
         * BUILDINGS
         */
         $buildings = new CPT(
             array(
                 'post_type_name' => 'buildings',
                 'singular' => __( 'Building', 'host'),
                 'plural' => __( 'Buildings', 'host'),
                 // 'slug' => __( 'buildings', 'host'),
             ),
             array(
                 'show_in_nav_menus' => true,
                 'hierarchical' => true,
                 'supports' => array(
                     'title',
                     'editor',
                     'thumbnail',
                     'page-attributes'
                 ),
                'rewrite' => array(
                    'slug' => __( 'locations/%location_name%', 'host'),
                )
             )
         );
         $buildings->menu_icon("dashicons-building");
    }
}
