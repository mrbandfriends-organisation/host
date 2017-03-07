<?php
    use Roots\Sage\Utils;

    global $post;
    $post_id = $post->ID;
    $post_slug = $post->post_name;

    $test_doc = get_field('test_document');
    // var_dump($test_doc);
    
?>


    <?php
        $connected_location = host_building_find_connected_location(get_the_id())->post;
        $connected_location_name = $connected_location->post_title;
        $connected_location_slug = $connected_location->post_name;

        $twitter_link       = get_field('building_twitter');
        $facebook_link      = get_field('building_facebook');
        $instagram_link     = get_field('building_instagram');


    ?>

    <a href="/locations/<?=$connected_location_slug;?>/<?=$post_slug;?>/documents/<?=$test_doc['name'];?>/"><?=$test_doc['title'];?></a>

    <?php echo Utils\ob_load_template_part('templates/partials/shared/header-carousel', array(
            
            'info_box' => Utils\ob_load_template_part('templates/snippets/shared/carousel-infobox', array(
                'building_name'     => get_the_title(),
                'address_1'         => get_field('building_address_1'),
                'address_2'         => get_field('building_address_2'),
                'town'              => get_field('building_address_town_city'),
                'post_code'         => get_field('building_address_post_code'),
                'phone'             => get_field('building_address_phone_no'),
                'email'             => get_field('building_email_address'),
                'social_links'      => array(
                    'twitter'   => $twitter_link,
                    'facebook'  => $facebook_link,
                    'instagram' => $instagram_link
                )
            ) // end of attrs passed to infobox component
        )
    )); ?>

    <?php echo Utils\ob_load_template_part('templates/partials/building/building-intro', compact('connected_location_name')); ?>

    <?php echo Utils\ob_load_template_part('templates/partials/building/building-rooms', compact('connected_location_name')); ?>

    <?php echo Utils\ob_load_template_part('templates/partials/building/building-facilities', compact('connected_location_name')
    ); ?>

    <?php echo Utils\ob_load_template_part('templates/partials/building/building-things-to-do', compact('connected_location_name')
    ); ?>

    <?php echo Utils\ob_load_template_part('templates/partials/shared/map', compact('connected_location_name')
    ); ?>

    <?php echo Utils\ob_load_template_part('templates/partials/building/building-related-location-buildings', compact('connected_location_name')
    ); ?>

    <?php echo Utils\ob_load_template_part('templates/partials/building/building-people', compact('connected_location_name')
    ); ?>

    <?php echo Utils\ob_load_template_part('templates/partials/shared/testimonials'); ?>
