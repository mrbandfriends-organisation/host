<?php
    use Roots\Sage\Utils;

    $image      = ( !empty($image['url']) ? $image['url'] : null );
    $modifier   = ( !empty($modifier) ? $modifier : null );
    $alt        = ( !empty($image['alt']) ? 'alt="' . esc_html($image['alt']) . '"' : 'alt="' . $alt_title . ' logo"' );
?>
<?php if ( !empty($image) ): ?>
    <div class="uni-information__logo-container">
        <img src="<?php echo esc_url($image) ?>" <?php echo Utils\esc_textarea__($alt); ?> class="uni-information__logo" />
    </div>
<?php endif; ?>
