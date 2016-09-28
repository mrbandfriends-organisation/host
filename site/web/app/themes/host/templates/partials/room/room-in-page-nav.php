<?php
    use Roots\Sage\Utils;
?>

<nav class="in-page-nav js-sticky-nav fixedsticky">
    <div class="container grid">
        <div class="in-page-nav__aside gc m1-4 l1-3 grid">
            <div class="gc l1-2">
                <?php echo Utils\ob_load_template_part('templates/partials/shared/icon', [ 'icon' => 'site-logo', 'classnames' => 'in-page-nav__logo' ]); ?>
            </div>
            <div class="gc l1-2">
                <h2 class="h4 in-page-nav__heading">View this section:</h2>
            </div>
        </div>

        <ul class="in-page-nav__listing gc m3-4 l2-3 grid">
            <li class="in-page-nav__listing-item gc l1-6">
                <a href="#overview" class="in-page-nav__link js-in-page-link">
                    Room overview
                </a>
            </li>
            <li class="in-page-nav__listing-item gc l1-6">
                <a href="#details" class="in-page-nav__link js-in-page-link">
                    The details
                </a>
            </li>
            <li class="in-page-nav__listing-item gc l1-6">
                <a href="#gallery" class="in-page-nav__link js-in-page-link">
                    Gallery
                </a>
            </li>
            <li class="in-page-nav__listing-item gc l1-6">
                <a href="#pricing" class="in-page-nav__link js-in-page-link">
                    Pricing
                </a>
            </li>
            <li class="in-page-nav__listing-item gc l1-6">
                <a href="#location" class="in-page-nav__link js-in-page-link">
                    Location
                </a>
            </li>
            <li class="in-page-nav__listing-item gc l1-6">
                <a href="#awards" class="in-page-nav__link js-in-page-link">
                    Awards
                </a>
            </li>
        </ul>
    </div>
</nav>
