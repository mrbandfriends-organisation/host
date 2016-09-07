<?php
    use Roots\Sage\Utils;
?>
<!-- <div class="primary-offcanvas offcanvas__offscreen-right" aria-hidden="true"> -->
<div class="primary-offcanvas" aria-hidden="true">
    <button type="button" class="offcanvas-toggle offcanvas-toggle--close tcon tcon-menu--xcross tcon-transform js-offcanvas-toggle" aria-label="toggle menu">
        <span class="tcon-menu__lines" aria-hidden="true"></span>
        <span class="tcon-visuallyhidden">Close menu</span>
    </button>

    <div class="primary-offcanvas__section">
        <?php
            $offcanvas_nav_args = array(
                'modifier' => 'offcanvas'
            );
            echo Utils\ob_load_template_part('templates/menus/primary-nav.php', $offcanvas_nav_args);
        ?>
    </div>
</div>
