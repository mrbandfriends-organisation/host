<?php
/**
 * POST TYPES.
 *
 * Registers post types and taxonomies
 */

namespace HostPluginNamespace\App\Universities;

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
         * UNIVERSITIES
         */
         $universities = new CPT(
             array(
                 'post_type_name' => 'university',
                 'singular' => __( 'University', 'host'),
                 'plural' => __( 'Universities', 'host'),
                 'slug' => __( 'university', 'host'),
             ),
             array(
                 'show_in_nav_menus' => true,
                 'hierarchical' => true,
                 'supports' => array(
                     'title',
                     'editor',
                     'thumbnail',
                     'page-attributes'
                 )
             )
         );
         $universities->menu_icon("dashicons-welcome-learn-more");
    }
}
