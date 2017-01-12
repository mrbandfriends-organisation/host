<?php
    /**
    * GLOABL - HEADER CAROUSEL PARTIAL
    **/
    use Roots\Sage\Utils;
    use Roots\Sage\Assets;

    $carousel_images = get_field('carousel_images');
    $info_box = ( !empty($info_box) ? $info_box : null );

    // If there are no images, don’t bother doing anything
    if (!$carousel_images)
    {
        return;
    }
?>

<div class="slick-header-carousel-container band">
    <?php if ( !empty($info_box) ): ?>
        <?php echo $info_box; ?>
    <?php endif; ?>

    <ul class="slick-header-carousel js-slick-header-carousel">
        <?php foreach ( $carousel_images AS $image): ?>
            <li class="slick-header-carousel__slide js-rimgbg">
                <?php echo Assets\get_responsive_image($image['id'], array()); ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>