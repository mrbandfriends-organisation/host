<?php
    use Roots\Sage\Utils;
?>
<!-- <div class="primary-offcanvas offcanvas__offscreen-right" aria-hidden="true"> -->
<div class="primary-offcanvas" aria-hidden="true">
    <div class="flex">
        <div class="primary-offcanvas__logo-container">
            <a href="/" class="banner__home-link">
                <?php echo Utils\ob_load_template_part('templates/partials/shared/icon', [ 'icon' => 'site-logo', 'classnames' => 'svg-icon--site-logo svg-icon--white' ]); ?>
            </a>
        </div>

        <button type="button" class="offcanvas-toggle offcanvas-toggle--close tcon tcon-menu--xcross tcon-transform js-offcanvas-toggle" aria-label="toggle menu">
            <span class="tcon-menu__lines" aria-hidden="true"></span>
            <span class="tcon-visuallyhidden">Close menu</span>
        </button>
    </div>

    <div class="primary-offcanvas__section primary-offcanvas__language-changer">
        <?= do_shortcode('[GTranslate]');  ?>
    </div>

    <div class="primary-offcanvas__section">
        <?php
            $offcanvas_nav_args = array(
                'modifier' => 'offcanvas'
            );
            echo Utils\ob_load_template_part('templates/menus/primary-nav.php', $offcanvas_nav_args);
        ?>
    </div>

    <div class="primary-offcanvas__section primary-offcanvas__social-icons">
        <ul class="offcanvas-social-icons flex">
            <li class="offcanvas-social-icons__item">
                <a href="#" class="offcanvas-social-icons__link">
                    <?php echo Utils\ob_load_template_part('templates/partials/shared/icon', [ 'icon' => 'facebook', 'classnames' => 'svg-icon--sky' ]); ?>
                </a>
            </li>
            <li class="offcanvas-social-icons__item">
                <a href="#" class="offcanvas-social-icons__link">
                    <?php echo Utils\ob_load_template_part('templates/partials/shared/icon', [ 'icon' => 'twitter', 'classnames' => 'svg-icon--sky' ]); ?>
                </a>
            </li>
        </ul>
    </div>
</div>
