<?php
    use Roots\Sage\Utils;
    use Roots\Sage\Extras;

    $twitter_link   = ( !empty( get_field('twitter_page_link', 'options') ) ? get_field('twitter_page_link', 'options') : null );
    $facebook_link  = ( !empty( get_field('facebook_page_link', 'options') ) ? get_field('facebook_page_link', 'options') : null );
    $instagram_link = ( !empty( get_field('instagram_page_link', 'options') ) ? get_field('instagram_page_link', 'options') : null );
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
                    <?php if ( !empty($facebook_link) ): ?>
                        <li class="footer-marks__item">
                            <a href="<?php echo esc_url($facebook_link) ?>" class="footer-marks__link" <?php Extras\link_open_new_tab_attrs() ?>>
                                <?php echo Utils\ob_load_template_part('templates/partials/shared/icon', [ 'icon' => 'facebook', 'classnames' => 'svg-icon--sky svg-icon--hover' ]); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if ( !empty($twitter_link) ): ?>
                        <li class="footer-marks__item">
                            <a href="<?php echo esc_url($twitter_link) ?>" class="footer-marks__link" <?php Extras\link_open_new_tab_attrs() ?>>
                                <?php echo Utils\ob_load_template_part('templates/partials/shared/icon', [ 'icon' => 'twitter', 'classnames' => 'svg-icon--sky svg-icon--hover' ]); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if ( !empty($instagram_link) ): ?>
                        <li class="footer-marks__item">
                            <a href="<?php echo esc_url($instagram_link) ?>" class="footer-marks__link" <?php Extras\link_open_new_tab_attrs() ?>>
                                <?php echo Utils\ob_load_template_part('templates/partials/shared/icon', [ 'icon' => 'instagram', 'classnames' => 'svg-icon--sky svg-icon--hover' ]); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <li class="footer-marks__item -large">
                        <a href="http://www.nationalcode.org" class="footer-marks__link -large" <?php Extras\link_open_new_tab_attrs() ?>>
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
