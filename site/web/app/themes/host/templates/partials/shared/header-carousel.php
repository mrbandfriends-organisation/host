<?php
    /**
    * GLOABL - HEADER CAROUSEL PARTIAL
    **/
    use Roots\Sage\Utils;

    $carousel_images = get_field('carousel_images');

    // If there are no images, don’t bother doing anything
    if (!$carousel_images)
    {
        return;
    }
?>

<section class="band slideshow js-slideshow slideshow--light-pagination slideshow--animate-in slideshow--<?=count($carousel_images);?>-items" data-pagination="pn dots">
    <ul class="slideshow__list js-slideshow__list">
    <?php foreach ( $carousel_images AS $image): ?>
        <li class="slideshow__item js-slideshow__item" style="background-image:url(<?=$image['sizes']['large'];?>);">
            <img src="<?php echo $image['sizes']['large']; ?>" class="slideshow__image js-slideshow__image" alt="<?=$image['alt']; ?>">
        </li>
    <?php endforeach; ?>
    </ul>
</section>
