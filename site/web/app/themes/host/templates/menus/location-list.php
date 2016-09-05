<?php $locations = host_locations_find_all(); ?>

<?php if ( $locations->have_posts() ) : ?>
    <ul class="nav-footer__sublist">
        <strong class="nav-footer__section-header">
            <a href="" class="nav-footer__link">Locations</a>
        </strong>

        <?php while ( $locations->have_posts() ) : $locations->the_post(); ?>

        <?php
            $title = get_the_title();
            $url = get_permalink();
        ?>

            <li class="nav-footer__item">
                <a href="<?php echo esc_url($url); ?>" class="nav-footer__link"><?php echo esc_html($title); ?></a>
            </li>

        <?php endwhile; ?>
    </ul>

<?php endif; ?>
