<?php
    use Roots\Sage\Utils;

    $images                 = ( !empty($images) ? $images : null );
    $image_counter          = ( !empty($images) ? count($images) : null);
    $grid_modifier          = ( !empty($grid_modifier) ? $grid_modifier : null );
    $number_thumbs          = ( !empty($number_thumbs) ? $number_thumbs : 2 );          // Number thumbsnails to show
    $image_overlay_colour   = ( !empty($image_overlay_colour) ? 'stacked-gallery__bleed-image--' . $image_overlay_colour : null );
?>

<?php if ( !empty($images) ): ?>
    <div class="stacked-gallery-container grid <?php echo esc_attr($grid_modifier); ?>">

        <?php $counter = 0; ?>
        <?php for ($i=$counter; $i < $image_counter; $i++): ?>
        <?php //foreach ($images as $image): ?>
            <?php if ( $counter < $number_thumbs ): ?>
            <div class="stacked-gallery gc t1-2 l1-2">
                <a href="<?php echo
                    wpthumb(
                        esc_url($images[$i]['url']),
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
                        'image'     => esc_url($images[$i]['url']),
                        'modifier'  => 'stacked-gallery__bleed-image ' . $image_overlay_colour,
                         'alt'      => $images[0]['alt']
                    ] ); ?>
                </a>
            </div>
            <?php $counter++; ?>
        <?php endif; ?>
        <?php endfor; ?>

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
