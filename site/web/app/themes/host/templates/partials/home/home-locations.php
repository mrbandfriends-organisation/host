<?php
  /**
  * HOME LOCATIONS
  **/
    use Roots\Sage\Utils;
    use Roots\Sage\Extras;
    use Roots\Sage\RoomsBuildings;
?>

<?php
  $header_title_1 = (!empty($header_title_1)) ? $header_title_1 : get_field('header_title_1');
  $header_title_2 = (!empty($header_title_2)) ? $header_title_2 : get_field('header_title_2');
  $locations = (!empty($locations)) ? $locations : host_locations_find_all( ['order' => 'ASC', 'orderby' => 'title'] );

  $count = 0;
?>

<?php if ( $locations->have_posts() ) : ?>

    <section class="band checkerboard js-checkerboard" data-checkerboard-selector=".checkerboard-item">
        <header class="box box--red checkerboard__header">
            <h1><?php echo esc_html($header_title_1); ?><br />
            <?php echo esc_html($header_title_2); ?></h1>
        </header>

        <ul class="checkerboard__list grid">
            <?php while ( $locations->have_posts() ) : $locations->the_post(); ?>
                <?php
                    $checkerboard_field = get_field('checkerboard_image');
                    $carousel_field     = get_field('carousel_images');

                    // Get checkboard image
                    if ( !empty($checkerboard_field) ) {
                        $checkerboard_image = $checkerboard_field['url'];
                    }
                    // Get first carosuel image if there is no checkerboard image
                    elseif( !empty($carousel_field) ) {
                        $checkerboard_image = $carousel_field[0]['url'];
                    }
                    // If they BOTH dont work then use fallback image
                    else {
                        $checkerboard_image = get_template_directory_uri() . '/assets/images/london.jpg';
                    }
                ?>
                <li class="checkerboard__item gc">
                    <?php
                        $connected_buildings_array = host_location_find_connected_buildings(get_the_id());
                        $connected_buildings = $connected_buildings_array->posts;
                        $connected_buildings_count = count($connected_buildings);
                    ?>

                    <?php echo Utils\ob_load_template_part('templates/partials/home/home-locations-item.php', array(
                        'label'                 => get_the_title(),
                        'url'                   => get_permalink(),
                        'tile_image'            => $checkerboard_image,
                        'available_properties'  => $connected_buildings_count
                    )); ?>

                </li>
                <?php $count++; ?>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>

            <li class="checkerboard__sell gc js-checkerboard__item js-checkerboard__sell">
                <div class="checkerboard__sell-item box box--ink">
                    <?php
                        $get_homepage_id        = Utils\get_id_by_slug('home');
                        $homepage_id            = ( !empty($get_homepage_id) ? $get_homepage_id : null );
                        $home_featured_building = ( !empty(get_field('featured_building', $homepage_id)) ? get_field('featured_building', $homepage_id) : null );
                        $is_external            = get_field('external_website', $home_featured_building);
                        $external_url           = ( $is_external ) ? get_field('website_url', $home_featured_building) : null;

                        if ( !empty($home_featured_building) ) :
                    ?>
                        <h2 class="h3">Featured home<br>Our latest or greatest</h2>
                        <p>
                            <a href="<?= ( $is_external ) ? get_field('website_url', $home_featured_building) : get_the_permalink($home_featured_building);?>" class="btn btn--white btn--small" <?php ( $is_external ) ?: Extras\link_open_new_tab_attrs(); ?>>Show me featured homes</a>                        </p>
                    <?php endif; ?>

                </div>
            </li>
        </ul>

    </section>

<?php endif; ?>
