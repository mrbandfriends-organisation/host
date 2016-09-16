<?php
    $carousel_images = ( !empty($carousel_images) ? $carousel_images : null );
?>

<div class="slideshow js-slideshow slideshow--light-pagination" data-pagination="pn dots">
    <ul class="slideshow__list js-slideshow__list">
    <?php foreach ( $carousel_images AS $image): ?>
        <li class="slideshow__item js-slideshow__item" style="background-image:url(<?=$image['sizes']['large'];?>);">
            <img src="<?php echo $image['sizes']['large']; ?>" class="slideshow__image js-slideshow__image" alt="<?=$image['alt']; ?>">
        </li>
    <?php endforeach; ?>
    </ul>
</div>
