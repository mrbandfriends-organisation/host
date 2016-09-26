<?php
    Use Roots\Sage\Utils;
    use Roots\Sage\ajaxLoadPosts;


    echo Utils\ob_load_template_part('templates/components/listing', array(
        'post_per_page'  => 6,
        'post_type'      => 'post'
    ));
?>
