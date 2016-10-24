<?php if (!empty($carousel_images)): ?>
<div class="slideshow js-slideshow slideshow--light-pagination" data-pagination="pn dots">
    <ul class="slideshow__list js-slideshow__list">
    <?php foreach ( $carousel_images AS $image): ?>
        <?php
            $alt = ( !empty($image['alt']) ? $image['alt'] : null );
        ?>
        <li class="slideshow__item js-slideshow__item" style="background-image:url(<?= esc_url($image['sizes']['large']);?>);">
            <img src="<?=$image['sizes']['large']; ?>" class="slideshow__image js-slideshow__image" alt="<?= esc_attr($alt); ?>">
        </li>
    <?php endforeach; ?>
    </ul>
</div>
<?php endif ?>