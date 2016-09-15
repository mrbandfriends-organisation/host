<?php

    use Roots\Sage\RoomsBuildings;
    use Roots\Sage\Utils;

    $id = get_the_id();
    $aSlideshowConf = [
        "selector" => "#r{$id}",
        "offset"   => -1
    ];

    $room_category = get_the_category();
    $room_category = $room_category[0];

    $availability = get_field('availability');
    $from_amount = get_field('from_amount');
    $status = RoomsBuildings\availability_status($availability);
     ?>



<article id="r<?=$id; ?>" class="listed-room room-list__room">
    <div class="listed-room__content">
        <div class="listed-room__info box box--fg-grape box--less-padding">
            <h3 class="listed-room__title"><?=get_the_title();?></h3>
            <h4 class="listed-room__price h3 plain">From <?=$from_amount; ?></h4>

            <strong class="listed-room__avail box box--little-padding box--<?=$status['colour']; ?> h4 plain">
                <span class="vh">Availability:</span><?=$status['text']; ?>
            </strong>
            <p>
                <?=Utils\esc_textarea__(get_the_content()); ?>
            </p>
            <p>
                <a href="#" class="btn btn--small btn--narrow">More information</a>
            </p>
        </div>
        <aside class="listed-room__slideshow slideshow js-slideshow" data-pagination="pn dots" data-mirror-to="<?=esc_attr(json_encode($aSlideshowConf)); ?>">
            <ul class="slideshow__list js-slideshow__list">
                <?php
                    $photos = get_field('carousel_images');

                    foreach ($photos as $index => $photo):

                        $photo_title = $photo['title'];
                        $photo_url = $photo['url'];
                        $photo_2_url = $photos[$index]['url'];?>
                        <li class="slideshow__item js-slideshow__item" style="background-image:url(<?=esc_url($photo_2_url); ?>);">
                            <img src="<?php echo esc_url($photo_url); ?>" alt="<?php echo esc_attr($photo_title); ?>" title ="<?php echo esc_attr($photo_title); ?>" class="slideshow__image js-slideshow__image" />
                        </li>
                    <?php
                    endforeach;
                    ?>
            </ul>

        </aside>
    </div>
</article>
