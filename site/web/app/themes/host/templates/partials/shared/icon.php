<?php if ( !empty( $icon ) ): ?>
	<svg class="svg-icon <?php echo (!empty( $classnames ) ) ? "$classnames" : ''; ?>" aria-hidden="true" role="img">
	    <use xlink:href="#icon-<?php echo esc_attr( $icon ); ?>"></use>
	</svg>
<?php endif; ?>
