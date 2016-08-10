<?php 
/**
 * EXAMPLE REPOSITORY
 *
 * REPOSITORY for interacting with Examples in the system. Provides a simple
 * facade over the WordPress API functions
 *
 */
namespace HostPluginNamespace\Repos;

use \HostPluginNamespace\Repos\Contracts\Repo;
use \WP_Query as WP_Query;


class Example extends Repo {

	/**
	 * POST TYPE
	 * 
	 * set this to the post type you which to run WP_Query against
	 * utilised by the base Repo class
	 */
    protected static $post_type = 'example';
	

	public function __construct( WP_Query $query ) {
        $this->query = $query;
    }


	public static function init() {
		return new self( new WP_Query() );
	}
	
}