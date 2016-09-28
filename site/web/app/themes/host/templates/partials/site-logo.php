<?php
/**
* SITE LOGO.
*
* uses RIMG (via Picturefill or Native) to load either SVG or PNG fallback
* of the logo...
*/
?>

<a class="site-logo banner__home-link" href="<?php echo esc_url(home_url('/')); ?>" style="display: block; width: 200px;">
	<img src="<?php echo esc_attr(get_stylesheet_directory_uri().'/assets/svg/unoptimised/site-logo.svg'); ?>">
</a>
