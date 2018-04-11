<?php
/**
 * Enable Editor Access
 * Allow Editor-role users to access the Redirection configuration page.
 */


add_filter( 'redirection_role', function( $role ) {
return 'editor';
} );