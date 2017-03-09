<?php
    use Roots\Sage\Utils;
?>

<nav class="in-page-nav js-sticky-nav fixedsticky">
    <div class="in-page-nav__inner container">
        <div class="in-page-nav__aside">
            
                <?php echo Utils\ob_load_template_part('templates/partials/shared/icon', [ 'icon' => 'site-logo', 'classnames' => 'in-page-nav__logo' ]); ?>

                <p class="h4 in-page-nav__heading">View this section:</p>
            
        </div>

        <ul class="in-page-nav__listing">
            <li class="in-page-nav__listing-item">
                <a href="#overview" class="in-page-nav__link js-in-page-link">
                    <span>Room overview</span>
                </a>
            </li>
            <li class="in-page-nav__listing-item">
                <a href="#details" class="in-page-nav__link js-in-page-link">
                    <span>The details</span>
                </a>
            </li>
            <li class="in-page-nav__listing-item">
                <a href="#gallery" class="in-page-nav__link js-in-page-link">
                    <span>Gallery</span>
                </a>
            </li>
            <li class="in-page-nav__listing-item">
                <a href="#pricing" class="in-page-nav__link js-in-page-link">
                    <span>Pricing</span>
                </a>
            </li>
            <li class="in-page-nav__listing-item">
                <a href="#location" class="in-page-nav__link js-in-page-link">
                    <span>Location</span>
                </a>
            </li>
            <li class="in-page-nav__listing-item">
                <a href="#awards" class="in-page-nav__link js-in-page-link">
                    <span>Awards</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
