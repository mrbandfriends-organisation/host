<?php
    use Roots\Sage\Utils;
?>

<header class="banner js-banner" role="banner">
	<div class="banner__inner container">
		<div class="banner__section banner__brand">
            <a href="/" class="banner__home-link"><?php echo Utils\ob_load_template_part('templates/partials/shared/icon', [ 'icon' => 'site-logo' ]); ?></a>
		</div>

		<div class="banner__section banner__nav">
            <?php echo Utils\ob_load_template_part('templates/partials/utility-nav', [ 'modifier' => 'banner' ]); ?>

            <?php
                $banner_nav_args = array(
                    'modifier' => 'banner'
                );

                echo Utils\ob_load_template_part('templates/menus/primary-nav', $banner_nav_args);
            ?>

            <button id="menu-button" type="button" class="offcanvas-toggle offcanvas-toggle--open tcon tcon-menu--xcross js-offcanvas-toggle" aria-label="toggle menu" aria-expanded="false" aria-controls="menu">
                <span class="offcanvas-toggle__text"><span class="vh">Open</span> menu</span>
                <span class="offcanvas-toggle__lines tcon-menu__lines" aria-hidden="true"></span>
            </button>
		</div>


	</div>
</header>
