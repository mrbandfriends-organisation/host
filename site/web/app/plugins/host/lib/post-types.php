<?php

/**
 * POST TYPES
 *
 * Registers post types and taxonomies
 *
 */

namespace HostPluginNamespace\Lib;

use \CPT as CPT;

class Post_Types {

    /**
     * Creates a new instances of the Plugin Class
     */
    public static function init() {
        $self = new self();
        $self->start();
    }

    /**
     * Coordinates initialisation of Plugin
     */
    private function start() {
         $this->register_post_types();
    }

	/**
	 * Register core post types.
	 */
	private function register_post_types() {

		    // LOCATIONS
        $locations = new CPT(
            array(
                'post_type_name' => 'locations',
                'singular' => __( 'Location', 'host'),
                'plural' => __( 'Locations', 'host'),
                'slug' => __( 'locations', 'host'),
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
        $locations->menu_icon("dashicons-location");


        // BUILDINGS
        $buildings = new CPT(
            array(
                'post_type_name' => 'buildings',
                'singular' => __( 'Building', 'host'),
                'plural' => __( 'Buildings', 'host'),
                'slug' => __( 'buildings', 'host'),
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
        $buildings->menu_icon("dashicons-building");


        // ROOMS
        $rooms = new CPT(
            array(
                'post_type_name' => 'Rooms',
                'singular' => __( 'Room', 'host'),
                'plural' => __( 'Rooms', 'host'),
                'slug' => __( 'rooms', 'host'),
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
        $rooms->menu_icon("dashicons-admin-home");

	}
}
