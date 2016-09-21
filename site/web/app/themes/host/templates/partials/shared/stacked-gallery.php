<?php
    use Roots\Sage\Utils;

    $images         = ( !empty($images) ? $images : null );
    $image_counter  = ( !empty($images) ? count($images) : null);
    $modifier       = ( !empty($modifier) ? 'stacked-gallery__bleed-image--' . $modifier : 'stacked-gallery__bleed-image' );
?>

<?php if ( !empty($images) ): ?>
    <div class="stacked-gallery-container grid grid--vertical-l">

        <?php $counter = 0; ?>
        <?php foreach ($images as $image): ?>
            <?php if ( $counter < 4 ): ?>
            <div class="stacked-gallery gc t1-2 l1-2">
                <a href="<?php echo
                    wpthumb(
                        esc_url($image['url']),
                        array(
                            'width'  => 1000,
                            'crop'   => true,
                            'resize' => true
                        )
                    ); ?>"
                    class="stacked-gallery__link flex js-popup-gallery-trigger">
                    <div class="stacked-gallery__inner flex">
                        <strong class="stacked-gallery__label">See all <?php echo esc_html($image_counter); ?> photos</strong>
                        <?php echo Utils\ob_load_template_part('templates/partials/shared/icon', array(
                            'icon'          => 'camera',
                            'classnames'    => 'stacked-gallery__icon svg-icon--white'
                        )); ?>
                    </div>
                    <?php echo Utils\ob_load_template_part('templates/components/bleed-image', [
                        'image'     => $image['url'],
                        'modifier'  => $modifier
                    ] ); ?>
                </a>
            </div>
            <?php $counter++; ?>
        <?php endif; ?>
        <?php endforeach; ?>

        <?php // temp soloution for popup gallery ?>
        <?php for ($i=$counter; $i < $image_counter; $i++): ?>
            <a href="<?php echo
                wpthumb(
                    esc_url($images[$i]['url']),
                    array(
                        'width'  => 1000,
                        'crop'   => true,
                        'resize' => true
                    )
                ); ?>"
                class="js-popup-gallery-trigger vh">
            </a>
        <?php endfor; ?>
    </div>
<?php endif; ?>
