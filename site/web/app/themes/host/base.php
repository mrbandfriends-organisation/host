<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;
use Roots\Sage\Utils;

?>

<!doctype html>
<html <?php language_attributes(); ?>>
	<?php get_template_part('templates/head'); ?>
	<body <?php body_class(); ?>>
		<div class="offcanvas__wrapper js-offcanvas__wrapper">
			<div id="page" class="page offcanvas__body js-offcanvas-body">
				<?php
					do_action('get_header');
					get_template_part('templates/header');
				?>
				<main class="wrap container" role="document">
					<div class="content row">
						<div class="main">
							<?php include Wrapper\template_path(); ?>
						</div><!-- /.main -->
						<?php if (Setup\display_sidebar()) : ?>
							<aside class="sidebar">
								<?php include Wrapper\sidebar_path(); ?>
							</aside><!-- /.sidebar -->
						<?php endif; ?>
					</div><!-- /.content -->
				</main><!-- /.wrap -->
			</div>
			<?php echo Utils\ob_load_template_part('templates/partials/primary-offcanvas.php');?>
		</div>

		<?php
			do_action('get_footer');
			get_template_part('templates/footer');
			wp_footer();
		?>
	</body>
</html>
