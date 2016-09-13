<?php
    use Roots\Sage\Utils;
 ?>

<?php
    $id = substr(uniqid(), 0, 4);
?>

<section class="band band--inset-alt room-list">
    <?php Utils\ob_load_template_part('templates/components/room-list/header', [
        'id'    => $id,
        'title' => $title,
        'intro' => $intro,
        'rooms' => $rooms
    ]); ?>

    <ul class="room-list__list">
    <?php foreach ($rooms AS $idx => $aRoom): $aRoom['id'] = "{$id}-{$idx}"; ?>
        <li class="room-list__item">
            <?php echo Utils\ob_load_template_part('templates/components/room-list/room', $aRoom); ?>
        </li>
    <?php endforeach; ?>
    </ul>
</section>
