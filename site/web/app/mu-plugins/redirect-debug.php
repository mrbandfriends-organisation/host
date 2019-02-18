<?php

/*
Plugin Name: Quiet Redirect Debug
Description: Show all redirects
Version: 0.1
*/

add_filter( 'wp_redirect', function( $url ) {
  error_log( print_r( debug_backtrace(), true ) );
} );