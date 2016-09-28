<div class="primary-offcanvas offcanvas__offscreen-right js-primary-offcanvas" aria-hidden="true" aria-labelledby="menu-button">
    <button type="button" class="offcanvas-toggle offcanvas-toggle--close tcon tcon-menu--xcross tcon-transform js-offcanvas-toggle" aria-label="toggle menu">
        <span class="tcon-menu__lines" aria-hidden="true"></span>
        <span class="tcon-visuallyhidden">Close menu</span>
    </button>
    <div class="primary-offcanvas__section">
    <?php
        $offcanvas_nav_args = array(
            'modifier' => 'offcanvas'
        );

        $this->insert('partials::primary-nav', $offcanvas_nav_args);
    ?>
    </div>
</div>
