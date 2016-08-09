<section class="band band--inset-alt room-list">
    <h2 class="vh"><?=$title; ?></h2>

    <ul class="room-list__list">
    <?php foreach ($rooms AS $aRoom): ?>
        <li class="room-list__item">
            <?php $this->insert('component::room-list-room', $aRoom); ?>
        </li>
    <?php endforeach; ?>
    </ul>
</section>
