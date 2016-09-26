<?php
    Use Roots\Sage\Utils;
    use Roots\Sage\ajaxLoadPosts;


    echo Utils\ob_load_template_part('templates/components/listing', array(
        'page_id'           => get_option( 'page_for_posts' ),
        'post_loader_class' => 'js-news-post-loader',
        'post_per_page'     => 6,
        'post_type'         => 'post'
    ));
?>
