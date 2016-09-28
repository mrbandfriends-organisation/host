<footer role="contentinfo" class="footer">
	<div class="container">
		<div class="footer__section footer__brand">
		    <a href="/" class="footer__brand-link"><?php $this->insert('partials::shared/icon', [ 'icon' => 'host-logo' ]); ?></a>
		</div>
        <div class="footer__section footer__nav">
            <?php $this->insert('partials::footer-nav'); ?>
        </div>
        <div class="footer__section footer__final">
            <?php $this->insert('partials::footer-utilities'); ?>

            <nav class="footer-marks">
                <ul class="footer-marks__list">
                    <li class="footer-marks__item">
                        <a href="#" class="footer-marks__link">
                            <?php $this->insert('partials::shared/icon', [ 'icon' => 'facebook' ]); ?>
                        </a>
                    </li>
                    <li class="footer-marks__item">
                        <a href="#" class="footer-marks__link">
                            <?php $this->insert('partials::shared/icon', [ 'icon' => 'twitter' ]); ?>
                        </a>
                    </li>
                    <li class="footer-marks__item -large">
                        <a href="#" class="footer-marks__link -large">
                            <?php $this->insert('partials::shared/icon', [ 'icon' => 'national-code', 'classnames' => 'larger' ]); ?>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
	</div>
</footer>
