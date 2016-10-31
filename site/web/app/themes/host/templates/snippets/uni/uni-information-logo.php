<?php
    use Roots\Sage\Utils;

    $uni_id     = get_the_id();
    //$image      = ( !empty($image['url']) ? $image['url'] : null );

    if ( !empty($image) ) {
        $image = ( !empty($image) ? $image['url'] : null );
    } elseif ( host_universities_find_connected_location($uni_id) ) {
        $connected_location       = host_universities_find_connected_location($uni_id);
        $connected_location_id    = $connected_location->posts[0]->ID;
        $connected_location_image = get_field('carousel_images', $connected_location_id);
        $fallback_image           = ( !empty($connected_location_image) ? $connected_location_image[0]['url'] : null );
    }

    $modifier   = ( !empty($modifier) ? $modifier : null );
    $alt        = ( !empty($image['alt']) ? 'alt="' . esc_html($image['alt']) . '"' : 'alt="' . $alt_title . ' logo"' );
?>
<?php if ( !empty($image) ): ?>
    <div class="uni-information__logo-container">
        <img src="<?php echo esc_url($image) ?>" <?php echo Utils\esc_textarea__($alt); ?> class="uni-information__logo" />
    </div>
<?php endif; ?>

<?php if ( !empty($fallback_image) ): ?>
    <?php echo Utils\ob_load_template_part('templates/components/bleed-image', array(
        'image'  => $fallback_image,
        'alt'    => $connected_location_image[0]['alt']
    )); ?>
<?php endif; ?>
