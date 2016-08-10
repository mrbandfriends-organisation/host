<?php
/**
 * ABSTRACT REPO BASE CLASS
 *
 * provides standard API abstraction for working with WP_Query
 */

namespace HostPluginNamespace\Repos\Contracts;

abstract class Repo {

	public $query;

	public function find_one( array $args=array() ) {
		$args = array_merge($args,array(
            'posts_per_page' => 1,
        ));

        $posts = $this->fetch( $args );

        return count($posts) ? $posts : null;
	}


    public function find_all( array $args=array() ) {
        $args = array_merge( $args, array(
            'posts_per_page' => -1,
        ));

        $posts = $this->fetch( $args );

        return count($posts) ? $posts : null;
    }


	public function find_by_id($id) {
        return $this->find_one(array(
        	'p' => $id
        ));
    }

    public function find_by_taxonomy( $tax, $terms ) {

        $args = array(
            'tax_query' => array(
                array(
                    'taxonomy' => $tax,
                    'field'    => 'slug',
                    'terms'    => (array) $terms,
                ),
            ),
        );

        $posts = $this->fetch( $args );

        return count($posts) ? $posts : null;
    }



    private function fetch( array $args=array() ) {
		$args = array_merge(array(
            'post_type'         => static::$post_type,
            'post_status' 		=> 'publish',
            'posts_per_page'    => -1, // no paging,
            'orderby'           => array(
                'menu_order' => 'ASC'
            ),
            // NOTE: the following x2 rules could cause unexpected behaviour if not anticipated
            // they improve perf by removing unecessary SQL queries but if you are using terms
            // or you are doing pagination you need to overide them!
            'no_found_rows' => true, // counts posts, remove if pagination required
            'update_post_term_cache' => false, // grabs terms, remove if terms required (category, tag...)
        ), $args);

        $this->query->query($args);

        return $this->query;
	}



    
}
