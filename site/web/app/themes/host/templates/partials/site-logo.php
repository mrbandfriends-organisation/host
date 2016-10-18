<?php
/**
* SITE LOGO.
*
* uses RIMG (via Picturefill or Native) to load either SVG or PNG fallback
* of the logo...
*/
?>

<a class="site-logo banner__home-link" href="<?php echo esc_url(home_url('/')); ?>">
	<?php // note we're using an unoptimised SVG because the optimised version looked TERRIBLE in IE11 which isn't so good at rendering ?>
	<img src="<?php echo esc_attr(get_stylesheet_directory_uri().'/assets/svg/unoptimised/site-logo.svg'); ?>" alt="Host Students - Where students are at home">
</a>
