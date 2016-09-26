<?php

namespace Roots\Sage\ajaxLoadPosts;
use Roots\Sage\Utils;
use \WP_Query as WP_Query;


// =================================================================================
// STUARTS AJAX CODE
// =================================================================================

function ajax_load_post_query( $options = array() ) {
    $defaults = array(
        'paged'          => 1,
        'posts_per_page' => 6,
        'post_type'      => 'post',
        //'order'          => 'ASC',
        //'orderby'        => 'date'
    );

    $options = array_merge($defaults, (array)$options);

    $args = array(
        'paged'             => $options['paged'],
        'posts_per_page'    => $options['posts_per_page'],
        'post_type'         => $options['post_type'],
        //'order'             => $options['order'],
        //'orderby'           => $options['orderby']
    );

    // 2. query
    $qry = new WP_Query($args);

    // 3. and return
    return $qry;
}


function load_posts() {
    // $_REQUEST contains the params passed through in the AJAX request
   $paged           = ( !empty( $_REQUEST["paged"] ) ) ? $_REQUEST["paged"] : 2;
   $posts_per_page  = ( !empty( $_REQUEST["postsPerPage"] ) ) ? $_REQUEST["postsPerPage"] : $options['posts_per_page'];
   $post_type       = ( !empty( $_REQUEST["postType"] ) ) ? $_REQUEST["postType"] : $options['post_type'];

   // Reuse same template helper as when using standard server side generated
   // WordPress templates
   $query = ajax_load_post_query( array(
       'paged'          => $paged,
       'posts_per_page' => $posts_per_page,
       'post_type'      => $post_type
   ));

   $result = Utils\ob_load_template_part('templates/partials/listing/article-loop.php', array(
       'query' => $query
   ));

   echo $result;

   wp_die();
}
add_action( 'wp_ajax_host_load_posts', __NAMESPACE__ . '\\load_posts' );
add_action( 'wp_ajax_nopriv_host_load_posts', __NAMESPACE__ . '\\load_posts' );

?>
