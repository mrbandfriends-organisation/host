<head>
    <?php wp_head(); ?>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="norton-safeweb-site-verification" content="mi48-tcrp5tocsvxj7gm6eph5g8e9bxvuwpj1b8zdrk4wbrq9y5sij0-5vpd24c4d5jlvty3vrmxz1wpyjm-qlae603ltzfj5p5l80f3efbfxxpnyvjkeao9zm1u5wo9" />

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
