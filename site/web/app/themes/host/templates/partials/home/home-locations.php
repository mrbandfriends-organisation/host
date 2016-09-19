<?php
  /**
  * HOME LOCATIONS
  **/
    use Roots\Sage\Utils;
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
                    $carousel_image = get_template_directory_uri() . '/assets/images/london.jpg';
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
                        'tile_image'            => $carousel_image,
                        'available_properties'  => $connected_buildings_count
                    )); ?>
                    
                </li>
                <?php $count++; ?>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>

            <li class="checkerboard__sell gc js-checkerboard__item js-checkerboard__sell">
                <div class="box box--ink">
                    <h3>Featured home<br>Our latest or greatest</h3>

                    <p>
                        <a href="/building.php" class="btn btn--white btn--small">Show me featured homes</a>
                    </p>
                </div>
            </li>
        </ul>

    </section>

<?php endif; ?>
