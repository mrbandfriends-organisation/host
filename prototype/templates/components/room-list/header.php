<header class="room-list__header">
    <div class="room-list__header-inner container grid">
        <div class="room-list__title-info gc l1-2 box box--fg-grape">
            <h2><?=$title; ?></h2>
            <p><?=$intro; ?></p>
        </div>
        <nav class="room-list__nav gc l-30pc box box--grape">
            <h3>Take a look at<br>our room types</h3>

            <ul class="separated-list">
            <?php foreach ($rooms AS $idx => $aRoom): ?>
                <li class="separated-list__item">
                    <a href="#<?="{$id}-{$idx}"; ?>"><?=$aRoom['title']; ?></a>
                </li>
            <?php endforeach; ?>
            </ul>
        </nav>
    </div>
</header>
