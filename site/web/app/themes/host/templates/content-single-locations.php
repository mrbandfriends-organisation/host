<?php
    use Roots\Sage\Utils;

    echo Utils\ob_load_template_part('templates/partials/shared/header-carousel.php');

    if ( !( get_field('hide_header', get_the_ID() ) ) ) {

        echo Utils\ob_load_template_part('templates/partials/location/location-intro.php');

    }

    echo Utils\ob_load_template_part('templates/partials/location/location-buildings.php');

    if ( !( get_field('hide_map', get_the_ID() ) ) ) {

        echo Utils\ob_load_template_part('templates/partials/location/location-attractions.php');

        echo Utils\ob_load_template_part('templates/partials/shared/map');

    }

    if ( !( get_field('hide_news', get_the_ID() ) ) ) {

        echo Utils\ob_load_template_part('templates/partials/blog/view-all');

        echo Utils\ob_load_template_part('templates/partials/shared/news-feed.php');

    }