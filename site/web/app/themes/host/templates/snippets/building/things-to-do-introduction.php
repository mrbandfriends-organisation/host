<?php
    use Roots\Sage\Utils;
?>

<?php if ( !empty($location_title_1) && !empty($location_title_2) ): ?>
    <h2>
        <?=esc_html($location_title_1); ?>
        <br>
        <?=esc_html($location_title_2); ?>
    </h2>
<?php endif; ?>

<?php if ( !empty($location_city) ): ?>
    <p>
        <strong><?=esc_html($location_city); ?>:</strong>
    </p>
<?php endif; ?>

<?php if ( !empty($location_overview) ): ?>
    <?= Utils\esc_textarea__($location_overview); ?>
<?php endif; ?>

<?php if ( !empty($location_id) && !empty( $location_city ) ): ?>
    <a class="btn btn--primary" href="<?php echo esc_attr( get_permalink( $location_id ) );?>">Discover <?=esc_html($location_city); ?></a>
<?php endif; ?>


