<?php
    use Roots\Sage\Utils;
 ?>

<section id="rooms-nav" class="band band--inset-alt room-list">
    <?php echo Utils\ob_load_template_part('templates/components/room-list/header', compact('id', 'title', 'intro', 'rooms' )); ?>

    <ul class="room-list__list">

        <?php while ( $rooms->have_posts() ) : $rooms->the_post(); ?>
            <li class="room-list__item">
                <?php echo Utils\ob_load_template_part('templates/components/room-list/room'); ?>
            </li>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>

    </ul>
</section>
