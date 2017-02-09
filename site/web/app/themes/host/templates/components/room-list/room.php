<?php

    use Roots\Sage\Assets;
    use Roots\Sage\RoomsBuildings;
    use Roots\Sage\Utils;

    global $post;
    $post_slug = sanitize_title(get_the_title());
    $room_id = get_the_id();

    $id = "room-{$post_slug}";


    $aSlideshowConf = [
        "selector" => "#{$id}",
        "offset"   => -1
    ];

    $from_amount        = get_field('from_amount');
    

    // Get status of the Room or the Building (if overide is specified at Building level)
    $availability_status = RoomsBuildings\room_building_availability( $room_id, $building_status);
    
?>

<article id="<?=esc_attr( $id ); ?>" class="listed-room room-list__room">
    <div class="listed-room__content">
        <div class="listed-room__info box box--fg-grape box--less-padding">
            <h3 class="listed-room__title"><?=get_the_title();?></h3>
            <h4 class="listed-room__price h3 plain">From <?=$from_amount; ?></h4>

            <strong class="listed-room__avail box box--little-padding box--<?=$availability_status['colour']; ?> h4 plain">
                <span class="vh">Availability:</span><?=$availability_status['text']; ?>
            </strong>
            <p>
                <a href="<?= esc_url(get_permalink()); ?>" class="btn btn--small btn--narrow">More information</a>
            </p>
        </div>
        <aside class="listed-room__slideshow slideshow js-slideshow" data-pagination="pn dots" data-mirror-to="<?=esc_attr(json_encode($aSlideshowConf)); ?>">
            <ul class="slideshow__list js-slideshow__list">
                <?php
                    $photos = get_field('carousel_images');

                    foreach ($photos as $index => $photo):

                        $photo_title = $photo['title'];
                        $photo_id    = $photo['id'];
                        $photo_2_id  = $photos[$index]['id'];
                ?>

                        <li class="slideshow__item js-slideshow__item box--blue js-rimgbg">
                            <?= // This is for the main background image
                                Assets\get_responsive_image($photo_2_id, array(
                                ));
                            ?>


                            <?= // This is for the small image with the color overlay
                                Assets\get_responsive_image($photo_id, array(
                                    "alt"        => $photo_title,
                                    "class"      => "slideshow__image js-slideshow__image",
                                    'dimensions' => [320]
                                ));
                            ?>
                        </li>
                    <?php
                        endforeach;
                    ?>
            </ul>
        </aside>
    </div>
</article>
