<?php
    use Roots\Sage\Utils;

    echo Utils\ob_load_template_part('templates/partials/shared/header-carousel.php');

    echo Utils\ob_load_template_part('templates/partials/location/location-intro.php');

    echo Utils\ob_load_template_part('templates/partials/location/location-buildings.php');

    echo Utils\ob_load_template_part('templates/partials/location/location-attractions.php');

    echo Utils\ob_load_template_part('templates/partials/shared/map');

    //echo Utils\ob_load_template_part('templates/partials/location/location-news.php');
    echo Utils\ob_load_template_part('templates/partials/blog/view-all');

    echo Utils\ob_load_template_part('templates/partials/shared/news-feed.php');
