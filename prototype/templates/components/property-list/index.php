<section class="band band--inset-alt property-list">
    <h2 class="vh"><?=$title; ?></h2>

    <ul class="property-list__list">
    <?php foreach ($properties AS $aProperty): ?>
        <li class="property-list__item">
            <?php $this->insert('component::property-list/property', $aProperty); ?>
        </li>
    <?php endforeach; ?>
    </ul>
</section>
