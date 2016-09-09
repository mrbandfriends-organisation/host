<?php
    use Roots\Sage\Utils;

    $images         = ( !empty($images) ? $images : null );
    $image_counter  = ( !empty($images) ? count($images) : null);
    $modifier       = ( !empty($modifier) ? 'stacked-gallery__bleed-image--' . $modifier : 'stacked-gallery__bleed-image' );
?>

<?php if ( !empty($images) ): ?>
    <div class="stacked-gallery-container grid grid--vertical-l">

        <?php  ?>
        <?php foreach ($images as $image): ?>
            <div class="stacked-gallery gc t1-2 l1-2">
                <a href="<?php echo esc_url($image['image']) ?>" class="stacked-gallery__link flex js-popup-gallery-trigger">
                    <div class="stacked-gallery__inner flex">
                        <strong class="stacked-gallery__label">See all <?php echo esc_html($image_counter); ?> photos</strong>
                        <?php echo Utils\ob_load_template_part('templates/partials/shared/icon', array(
                            'icon'          => 'twitter',
                            'classnames'    => 'stacked-gallery__icon svg-icon--white'
                        )); ?>
                    </div>
                    <?php echo Utils\ob_load_template_part('templates/components/bleed-image', [
                        'image'     => $image['image'],
                        'modifier'  => $modifier
                    ] ); ?>
                </a>
            </div>
        <?php endforeach; ?>

    </div>
<?php endif; ?>
