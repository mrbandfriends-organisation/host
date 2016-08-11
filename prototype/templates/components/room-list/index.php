<?php
    $id = substr(uniqid(), 0, 4);
?>

<section class="band band--inset-alt room-list">
    <?php $this->insert('component::room-list/header', [
        'id'    => $id,
        'title' => $title,
        'intro' => $intro,
        'rooms' => $rooms
    ]); ?>

    <ul class="room-list__list">
    <?php foreach ($rooms AS $idx => $aRoom): $aRoom['id'] = "{$id}-{$idx}"; ?>
        <li class="room-list__item">
            <?php $this->insert('component::room-list/room', $aRoom); ?>
        </li>
    <?php endforeach; ?>
    </ul>
</section>
