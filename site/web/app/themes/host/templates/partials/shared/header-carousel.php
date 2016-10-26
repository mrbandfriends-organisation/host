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

<div class="band slideshow js-slideshow slideshow--large-pagination slideshow--light-pagination slideshow--animate-in" data-pagination="pn dots">
    <ul class="slideshow__list js-slideshow__list">
        
        <?php echo $info_box; ?>

        <?php foreach ( $carousel_images AS $image): ?>
            <li class="slideshow__item js-slideshow__item" style="background-image:url(<?=$image['sizes']['large'];?>);">
                <img src="<?php echo $image['sizes']['large']; ?>" class="slideshow__image js-slideshow__image" alt="<?=$image['alt']; ?>">

            </li>
        <?php endforeach; ?>
    </ul>
</div>
