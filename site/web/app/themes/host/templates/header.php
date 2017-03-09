<?php
    use Roots\Sage\Utils;

?>

<div class="site-header"><?php // exists as wrapper in order to allow for `order` to swap banner and utils visually ?>

    <header class="banner js-banner" role="banner">
    	<div class="banner__inner container">
    		<div class="banner__section banner__brand">
                <?php echo Utils\ob_load_template_part('templates/partials/site-logo'); ?>            
    		</div>

    		<div class="banner__section banner__nav">
                <?php
                    // echo Utils\ob_load_template_part('templates/partials/utility-nav', ['modifier' => 'banner']);
                    echo Utils\ob_load_template_part('templates/menus/primary-nav',    ['modifier' => 'banner']);
                ?>

                <button id="menu-button" type="button" class="offcanvas-toggle offcanvas-toggle--open tcon tcon-menu--xcross js-offcanvas-toggle" aria-label="toggle menu" aria-expanded="false" aria-controls="menu">
                    <span class="offcanvas-toggle__text"><span class="vh">Open</span> menu</span>
                    <span class="offcanvas-toggle__lines tcon-menu__lines" aria-hidden="true"></span>
                </button>
    		</div>


    	</div>
    </header>

    <?php
        echo Utils\ob_load_template_part('templates/partials/utility-nav', ['modifier' => 'banner']);
    ?>
</div>

