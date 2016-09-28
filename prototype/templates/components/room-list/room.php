<?php
    $aSlideshowConf = [
        "selector" => "#r{$id}",
        "offset"   => -1
    ];
?>

<article id="r<?=$id; ?>" class="listed-room room-list__room">
    <div class="listed-room__content">
        <div class="listed-room__info box box--fg-grape box--less-padding">
            <h3 class="listed-room__title"><?=$title;?></h3>
            <h4 class="listed-room__price h3 plain">From £<?=$price; ?><abbr title="per week">pw</abbr></h4>

            <strong class="listed-room__avail box box--little-padding box--<?=$status['color']; ?> h4 plain">
                <span class="vh">Availability:</span><?=$status['text']; ?>
            </strong>
            <p>
                <?=$description; ?>
            </p>
            <p>
                <a href="#" class="btn btn--small btn--narrow">More information</a>
            </p>
        </div>
        <aside class="listed-room__slideshow slideshow js-slideshow" data-pagination="pn dots" data-mirror-to="<?=esc_attr(json_encode($aSlideshowConf)); ?>">
            <ul class="slideshow__list js-slideshow__list">
            <?php foreach ($images AS $sImg): ?>
                <li class="slideshow__item js-slideshow__item" style="background-image:url(<?=$sImg; ?>);">
                    <img src="/_dummy/properties/room-ss2.th.jpg" class="slideshow__image js-slideshow__image" alt="">
                </li>
            <?php endforeach; ?>
            </ul>
        </aside>
    </div>
</article>
