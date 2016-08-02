<?php if ( !empty( $icon ) ): ?>

<?php
	$icon_fallback = '/assets/svg/sprites/output/png/' . $icon . '.png';
?>

<svg class="svg-icon <?php echo esc_attr( (!empty( $classnames ) ) ? "$classnames" : '' ); ?>" aria-labelledby="title desc" role="img">
    <use xlink:href="#icon-<?php echo esc_attr( $icon ); ?>"></use>
</svg>
<?php endif; ?>
