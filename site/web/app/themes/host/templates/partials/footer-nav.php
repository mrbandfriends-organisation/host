<?php
    use Roots\Sage\Utils;
?>

<nav class="menu-footer">
	<ul class="nav-footer js-nav-footer grid grid--divided">
        <li class="nav-footer__item nav-footer__section gc l4-6 m3-5">
            <?php echo Utils\ob_load_template_part('templates/menus/location-list.php'); ?>
        </li>

        <li class="nav-footer__item nav-footer__section gc l4-6 m3-5">
            <?php echo Utils\ob_load_template_part('templates/menus/footer-about.php'); ?>
        </li>
	</ul>
</nav>
