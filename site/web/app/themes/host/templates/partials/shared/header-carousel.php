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

<div class="band">
    <ul class="slick-header-carousel js-slick-header-carousel">

        <?php echo $info_box; ?>

        <?php foreach ( $carousel_images AS $image): ?>
            <li class="slick-header-carousel__slide js-rimgbg">
                <?php echo Assets\get_responsive_image($image['id'], array()); ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>


<!-- <li class="slideshow__item js-slideshow__item" style="background-image:url(<?//=$image['sizes']['large'];?>);">
    <img src="<?php //echo $image['sizes']['large']; ?>" class="slideshow__image js-slideshow__image" alt="<?//=$image['alt']; ?>">
</li> -->
