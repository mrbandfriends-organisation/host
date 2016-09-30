<?php
    use Roots\Sage\Utils;
?>

<?php
    // Page URL
    $page_url			= get_permalink();

    // Page title
    $page_title 		= get_the_title();
    $url_friendly_title	= urlencode( $page_title );

	// Social share URL's
	$facebook_share_url   = "http://www.facebook.com/sharer.php?u=" . $page_url;
    $twitter_share_url 	  = "https://twitter.com/share?url=" . $page_url . "&via=" . "techbenefits";
    $linkedin_share_url   = "https://www.linkedin.com/shareArticle?mini=true&url=" . $page_url . "&title=" . $url_friendly_title . "&summary=&source=TechBenefits";
    //$googleplus_share_url = "https://plus.google.com/share?url=" . $page_url;
?>



    <!-- <h3>
        Share this
    </h3> -->
	<ul class="social-icons">
	    <li class="social-icons__item <?php if(!empty($modifiers)): ?><?php echo esc_attr($modifiers); endif; ?>">
	        <a class="social-icons__link" href="<?php echo esc_url( $facebook_share_url ); ?>" <?php Utils\link_open_new_tab_attrs(); ?>>
	                <?php echo Utils\ob_load_template_part('templates/partials/shared/icon', array(
	                    'icon' => 'facebook',
	                    'class' => 'svg-icon--small'
	                ));?>
	        </a>
	    </li>
	    <li class="socialicons__item socialicons__item--twitter <?php if(!empty($modifiers)): ?><?php echo esc_attr($modifiers); endif; ?>">
	        <a class="socialicons__link" href="<?php echo esc_url( $twitter_share_url ); ?>" <?php Utils\link_open_new_tab_attrs(); ?>>
	            <div class="socialicons__icon-container">
	                <?php echo Utils\ob_load_template_part('templates/partials/shared/icon', array(
	                    'icon' => 'twitter',
	                    'class' => 'svg-icon--small'
	                ));?>
	            </div>
	        </a>
	    </li>
	    <li class="socialicons__item socialicons__item--linkedin <?php if(!empty($modifiers)): ?><?php echo esc_attr($modifiers); endif; ?>">
	        <a href="<?php echo esc_url( $linkedin_share_url ); ?>" <?php Utils\link_open_new_tab_attrs(); ?>>
	            <div class="socialicons__icon-container">
	                <?php echo Utils\ob_load_template_part('templates/partials/shared/icon', array(
	                    'icon' => 'linked-in',
	                    'class' => 'svg-icon--small'
	                ));?>
	            </div>
	        </a>
	    </li>
	</ul>
