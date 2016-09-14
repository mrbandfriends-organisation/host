<?php
    use Roots\Sage\Utils;
 ?>

<?php
    $id = substr(uniqid(), 0, 4);
?>

<section class="band band--inset-alt room-list">
    <?php echo Utils\ob_load_template_part('templates/components/room-list/header', compact('id', 'title', 'intro', 'rooms' )); ?>

    <ul class="room-list__list">

        <?php while ( $rooms->have_posts() ) : $rooms->the_post(); ?>
            <?php $aRoom['id'] = "{$id}-{$idx}"; ?>
            <li class="room-list__item">
                <?php echo Utils\ob_load_template_part('templates/components/room-list/room'); ?>
            </li>
        <?php endwhile; ?>

    </ul>
</section>
