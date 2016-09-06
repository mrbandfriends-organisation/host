<?php
  /**
  * HOME LOCATIONS
  **/
    use Roots\Sage\Utils;
?>

<?php
  $header_title_1 = get_field('header_title_1');
  $header_title_2 = get_field('header_title_2');
  $locations = host_locations_find_all(); ?>

<?php if ( $locations->have_posts() ) : ?>

    <section class="band checkerboard js-checkerboard" data-checkerboard-selector=".checkerboard-item">
        <header class="box box--red checkerboard__header">
            <h1><?php echo esc_html($header_title_1); ?><br />
            <?php echo esc_html($header_title_2); ?></h1>
        </header>

        <ul class="checkerboard__list grid">
            <?php while ( $locations->have_posts() ) : $locations->the_post(); ?>
                <?php
                    $carousel_images = get_field('carousel_images');
                    $carousel_image = $carousel_images[0]['sizes']['medium'];
                 ?>
                <li class="checkerboard__item gc">
                    <?php echo Utils\ob_load_template_part('templates/partials/home/home-locations-item.php', array(
                        'label'                 => get_the_title(),
                        'url'                   => get_permalink(),
                        'tile_image'            => $carousel_image,
                        'available_properties'  => 2
                    )); ?>
                </li>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>

            <li class="checkerboard__sell gc">
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
