<?php $locations = host_locations_find_all(); ?>

<?php if ( $locations->have_posts() ) : ?>
        <strong class="nav-footer__section-header">
            Locations
        </strong>

        <ul class="nav-footer__sublist">
        <?php while ( $locations->have_posts() ) : $locations->the_post(); ?>

        <?php
            $title = get_the_title();
            $url = get_permalink();
        ?>

            <li class="nav-footer__item">
                <?php echo esc_html($title); ?>
            </li>

        <?php endwhile; ?>
        </ul>

<?php endif; ?>
