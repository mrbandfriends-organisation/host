<?php
    use Roots\Sage\Utils;

    while (have_posts())
    {
        the_post();

        echo Utils\ob_load_template_part('templates/partials/shared/header-carousel.php');

        echo Utils\ob_load_template_part('templates/partials/location/location-intro.php');

        echo Utils\ob_load_template_part('templates/partials/location/location-buildings.php');

        echo Utils\ob_load_template_part('templates/partials/location/location-attractions.php');

        echo Utils\ob_load_template_part('templates/partials/shared/map');
    }
