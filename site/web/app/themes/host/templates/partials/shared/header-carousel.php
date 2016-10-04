<?php
    /**
    * GLOABL - HEADER CAROUSEL PARTIAL
    **/
    use Roots\Sage\Utils;

    $carousel_images = get_field('carousel_images');
    $info_box = ( !empty($info_box) ? $info_box : null );

    // If there are no images, don’t bother doing anything
    if (!$carousel_images)
    {
        return;
    }
?>

<section class="band">
<!-- <section class="band"> -->
    <!-- <ul class="slideshow__list js-slideshow__list"> -->
    <div class="js-slick-header-slider header-slider">
        <?php //echo $info_box; ?>

        <?php foreach ( $carousel_images AS $image): ?>
            <div class="slideshow__item flex" style="background-image:url(<?=$image['sizes']['large'];?>);"></div>
        <?php endforeach; ?>
    </div>
</section>
