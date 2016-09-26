<?php

namespace Roots\Sage\ajaxLoadPosts;
use Roots\Sage\Utils;
use \WP_Query as WP_Query;


// =================================================================================
// STUARTS AJAX CODE
// =================================================================================
function blog_post_query($paged=1, $posts_per_page=6) {
    $args = array(
        'post_type'         => 'post',
        'posts_per_page'    => $posts_per_page,
        'order'             => 'ASC',
        'paged'             => $paged
    );

    // 2. query
    $qry = new WP_Query($args);

    // 3. and return
    return $qry;
}


function load_posts() {
    // $_REQUEST contains the params passed through in the AJAX request
   $paged = ( !empty( $_REQUEST["paged"] ) ) ? $_REQUEST["paged"] : 2;

   // Reuse same template helper as when using standard server side generated
   // WordPress templates
   $query = blog_post_query( $paged );

   $result = Utils\ob_load_template_part('templates/partials/listing/article-loop.php', array(
       'query' => $query
   ));

   echo $result;

   wp_die();
}
add_action( 'wp_ajax_host_load_posts', __NAMESPACE__ . '\\load_posts' );
add_action( 'wp_ajax_nopriv_host_load_posts', __NAMESPACE__ . '\\load_posts' );

?>
