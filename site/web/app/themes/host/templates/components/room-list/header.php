<header class="room-list__header">
    <div class="room-list__header-inner grid">
        <div class="room-list__title-info gc l1-2 box box--fg-grape">
            <h2><?=$title; ?></h2>
            <?=$intro; ?>
        </div>
        <nav class="room-list-nav gc l-30pc box box--grape">
            <h3>Take a look at<br>our room types</h3>

            <ul class="room-list-nav__list separated-list">
            <?php while ( $rooms->have_posts() ) : $rooms->the_post(); ?>
                <li class="room-list-nav__item separated-list__item">
                    <a href="#room-<?= sanitize_title(get_the_title()); ?>" class="room-list-nav__link separated-list__link"><?=get_the_title(); ?></a>
                </li>
            <?php endwhile; ?>
            </ul>
        </nav>
    </div>
</header>
