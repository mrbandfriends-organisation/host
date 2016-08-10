<?php

/**
 * EXAMPLE 
 *
 * Container Class for "Example" functionality. 
 *
 */

namespace HostPluginNamespace\Lib;

class Example {


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
        $this->register_actions();
    }

    /**
     * Registers Actions with WP
     */
    private function register_actions() {
        //add_action( 'HOOK', array( $this, 'callback_method' ) );
    }

}
