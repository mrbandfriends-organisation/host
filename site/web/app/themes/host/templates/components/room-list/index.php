<?php
    use Roots\Sage\Utils;
    use Roots\Sage\RoomsBuildings;

    // Grab the building availability in advance 
    // pass down into the individual room
    $building_status    = RoomsBuildings\building_availability( $building_id ); 
 ?>

<section id="rooms" class="band band--inset-alt room-list">
    <?php echo Utils\ob_load_template_part('templates/components/room-list/header', compact('id', 'title', 'intro', 'rooms' )); ?>

    <ul class="room-list__list">

        <?php while ( $rooms->have_posts() ) : $rooms->the_post(); ?>
            <li class="room-list__item">
                <?php echo Utils\ob_load_template_part('templates/components/room-list/room', array(
                    'building_status' => $building_status
                )); ?>
            </li>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>

    </ul>
</section>
