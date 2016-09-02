<?php
/**
* SITE LOGO
*
* uses RIMG (via Picturefill or Native) to load either SVG or PNG fallback
* of the logo...
*/

?>

<a class="site-logo banner__home-link" href="<?php echo esc_url( home_url('/') ); ?>">
	<picture>
		<!--[if IE 9]><video style="display: none;"><![endif]-->
		<source type="image/svg+xml" srcset="<?php echo esc_attr( get_stylesheet_directory_uri() . '/assets/svg/standalone/output/site-logo.svg'); ?>">
		<!--[if IE 9]></video><![endif]-->
		<img src="<?php echo esc_attr(get_stylesheet_directory_uri() .'/assets/svg/standalone/output/png/site-logo.png'); ?>" alt="<?php echo esc_attr(bloginfo('name'));?>">
	</picture>
</a>
