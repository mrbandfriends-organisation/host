<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;
use Roots\Sage\Utils;

?>

<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<?php get_template_part('templates/head'); ?>
	<body <?php body_class(); ?>>
		<div class="offcanvas__wrapper js-offcanvas__wrapper">
			<div id="page" class="page offcanvas__body js-offcanvas-body">
				<?php
					do_action('get_header');
					get_template_part('templates/header');

                    ?>

                    <main id="main-content">
                        <?php include Wrapper\template_path(); ?>
                    </main>

                    <?php do_action('get_footer');
                    get_template_part('templates/footer');
				?>
			</div>
			<?php echo Utils\ob_load_template_part('templates/partials/primary-offcanvas.php'); ?>
		</div>

		<?php
            get_template_part('templates/partials/loadjs');
            get_template_part('templates/core/third-party-tools');

			wp_footer();
		?>
	</body>
</html>
