<head>
    <?php wp_head(); ?>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="norton-safeweb-site-verification" content="e5ul1r3uc2myef973-u7q-0wl5jav1j5wexxebbc70ilirvhl44z2596exy4fpb9mla6wd2rm4f6r48qy0trjp0fcu3aoiqdena1-hnnqwp7ly01jou6xgv59vwhlz0u" />

	<script>
		/**
		 * WEB FONT LOADING
		 */
		(function() {
			// Optimization for Repeat Views
			// https://www.zachleat.com/web-fonts/demos/fout-with-class.html			
			if( sessionStorage.foutFontsLoaded ) {
				document.documentElement.className += " wf-active wf-circular-web-400-loaded wf-circular-web-600-loaded";
				return;
			}								
		}());
	</script>
	

	<?php get_template_part('templates/core/meta-icons'); ?>
	<?php get_template_part('templates/core/fastboot-html-classes'); ?>
	<?php get_template_part('templates/core/critical-css'); ?>
	<?php get_template_part('templates/core/polyfills'); ?>
</head>
