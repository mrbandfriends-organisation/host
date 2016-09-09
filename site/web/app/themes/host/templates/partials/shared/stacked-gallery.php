<?php
    use Roots\Sage\Utils;

    $images     = ( !empty($images) ? $images : null );
?>

<?php if ( !empty($images) ): ?>
    <div class="stacked-gallery-container grid grid--vertical-l">

        <?php foreach ($images as $image): ?>
            <div class="stacked-gallery gc t1-2 l1-2">
                <a href="#" class="stacked-gallery__link flex">
                    <div class="stacked-gallery__inner flex">
                        <strong class="stacked-gallery__label">See all 12 photos</strong>
                        <?php echo Utils\ob_load_template_part('templates/partials/shared/icon', array(
                            'icon'          => 'twitter',
                            'classnames'    => 'stacked-gallery__icon svg-icon--white'
                        )); ?>
                    </div>
                    <?php echo Utils\ob_load_template_part('templates/components/bleed-image', [ 'image' => $image['image']] ); ?>
                </a>
            </div>
        <?php endforeach; ?>

    </div>
<?php endif; ?>
