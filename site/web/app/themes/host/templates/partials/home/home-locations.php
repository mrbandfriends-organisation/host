<?php
    /**
     * HOME LOCATIONS.
     **/
    use Roots\Sage\Utils;
    use Roots\Sage\Extras;

    ?>

<?php
  $header_title_1 = (!empty($header_title_1)) ? $header_title_1 : get_field('header_title_1');
  $header_title_2 = (!empty($header_title_2)) ? $header_title_2 : get_field('header_title_2');
  $locations = (!empty($locations)) ? $locations : host_locations_find_all(['order' => 'ASC', 'orderby' => 'title']);

  $count = 0;
?>

<?php if ($locations->have_posts()) : ?>

    <section class="band checkerboard js-checkerboard" data-checkerboard-selector=".checkerboard-item">
        <header class="box box--red checkerboard__header">
            <h1><?php echo esc_html($header_title_1); ?><br />
            <?php echo esc_html($header_title_2); ?></h1>
        </header>

        <ul class="checkerboard__list grid">
            <?php while ($locations->have_posts()) : $locations->the_post(); ?>
                <?php
                    $checkerboard_field         = get_field('checkerboard_image');
                    $carousel_field             = get_field('carousel_images');
                    $disable_am_i_feeling_lucky    = get_field('disable_am_i_feeling_lucky');
           

                    // Get checkboard image if it's specifically been added
                    if ( !empty($checkerboard_field) && !empty($checkerboard_field['url']) ) {
                        $checkerboard_image = $checkerboard_field['url'];
                    }
                    // Get first carosuel image if there is no checkerboard image
                    elseif (!empty($carousel_field)) {
                        $checkerboard_image = $carousel_field[0]['url'];
                    }
                    // If they BOTH dont work then use fallback image
                    else {
                        $checkerboard_image = get_template_directory_uri().'/assets/images/london.jpg';
                    }

                    // Massively reduce quality of images cos it's really not that obvious
                    $checkerboard_image = Utils\cdnify(wpthumb($checkerboard_image, 'jpeg_quality=10'));
                ?>
                <li class="checkerboard__item gc">
                    <?php
                        
                        $connected_buildings_array  = host_location_find_connected_buildings(get_the_id());
                        $connected_buildings        = $connected_buildings_array->posts;
                        $connected_buildings_count  = count($connected_buildings);
                    ?>

                    <?php echo Utils\ob_load_template_part('templates/partials/home/home-locations-item.php', array(
                        'label' => get_the_title(),
                        'location_permalink' => get_permalink(),
                        'tile_image' => $checkerboard_image,
                        'available_properties' => $connected_buildings_count,
                        'disable_am_i_feeling_lucky' => $disable_am_i_feeling_lucky,
                        'connected_buildings' => $connected_buildings
                    )); ?>

                </li>
                <?php ++$count; ?>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>

            <li class="checkerboard__sell gc js-checkerboard__item js-checkerboard__sell">
                <div class="checkerboard__sell-item box box--ink">
                    <?php
                        $get_homepage_id = Utils\get_id_by_slug('home');
                        $homepage_id = (!empty($get_homepage_id) ? $get_homepage_id : null);

                        if ( have_rows('featured_buildings', $homepage_id) ) :
                            while( have_rows('featured_buildings', $homepage_id) ) : the_row();
                                $home_featured_building = get_sub_field('building');
                                $is_external = get_field('external_website', $home_featured_building);
                                $external_url = ($is_external) ? get_field('website_url', $home_featured_building) : null;
                    ?>
                                <h2 class="h3">Featured home<br>Our latest or greatest</h2>
                                <p>
                                    <a href="<?= get_the_permalink($home_featured_building);?>" class="btn btn--white btn--small">Show me featured homes</a>
                                </p>
                    <?php
                            endwhile;
                        endif;
                    ?>

                </div>
            </li>
        </ul>

    </section>

<?php endif; ?>
