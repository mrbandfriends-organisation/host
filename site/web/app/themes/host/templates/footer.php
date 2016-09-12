<?php
    use Roots\Sage\Utils;
?>

<footer role="contentinfo" class="footer">
	<div class="container">
        <div class="footer-up-arrow-container flex">
            <a href="#" class="footer-up-arrow__link flex">
                <?php echo Utils\ob_load_template_part('templates/partials/shared/icon', [ 'icon' => 'arrow-left', 'classnames' => 'footer-up-arrow__icon svg-icon--sky' ]); ?>
            </a>
        </div>

		<div class="footer__section footer__brand">
		    <a href="/" class="footer__brand-link"><?php echo Utils\ob_load_template_part('templates/partials/shared/icon', [ 'icon' => 'host-logo' ]); ?></a>
		</div>

        <div class="footer__section footer__nav">
            <?php get_template_part('templates/partials/footer-nav'); ?>
        </div>

        <div class="footer__section footer__final">
            <?php get_template_part('templates/partials/footer-utilities'); ?>

            <nav class="footer-marks">
                <ul class="footer-marks__list">
                    <li class="footer-marks__item">
                        <a href="#" class="footer-marks__link">
                            <?php echo Utils\ob_load_template_part('templates/partials/shared/icon', [ 'icon' => 'facebook', 'classnames' => 'svg-icon--sky svg-icon--hover' ]); ?>
                        </a>
                    </li>
                    <li class="footer-marks__item">
                        <a href="#" class="footer-marks__link">
                            <?php echo Utils\ob_load_template_part('templates/partials/shared/icon', [ 'icon' => 'twitter', 'classnames' => 'svg-icon--sky svg-icon--hover' ]); ?>
                        </a>
                    </li>
                    <li class="footer-marks__item -large">
                        <a href="#" class="footer-marks__link -large">
                            <?php echo Utils\ob_load_template_part('templates/partials/shared/icon', [ 'icon' => 'national-code', 'classnames' => 'svg-icon--mark svg-icon--white' ]); ?>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
	</div>
</footer>


<?php get_template_part('templates/partials/corejs'); ?>

<?php get_template_part('templates/partials/third-party-tools'); ?>
