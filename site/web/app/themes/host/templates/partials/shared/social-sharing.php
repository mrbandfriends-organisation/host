<?php
    use Roots\Sage\Utils;
    use Roots\Sage\Extras;
?>

<?php
    // Page URL
    $page_url			= get_permalink();

    // Page title
    $page_title 		= get_the_title();
    $url_friendly_title	= urlencode( $page_title );

	// Social share URL's
	$facebook_share_url   = "http://www.facebook.com/sharer.php?u=" . $page_url;
    $twitter_handle       = ( !empty(get_field('twitter_handle', 'options')) ? get_field('twitter_handle', 'options') : null );
    $twitter_share_url    = ( !empty($twitter_handle) ? "https://twitter.com/share?url=" . $page_url . "&via=" . $twitter_handle : null );
    $linkedin_share_url   = null;
    //$linkedin_share_url   = "https://www.linkedin.com/shareArticle?mini=true&url=" . $page_url . "&title=" . $url_friendly_title . "&summary=&source=TechBenefits";
    //$googleplus_share_url = "https://plus.google.com/share?url=" . $page_url;
?>



    <!-- <h3>
        Share this
    </h3> -->
    <div class="social-sharing-container">
        <strong>Share this: </strong>
    	<ul class="social-sharing">
            <?php if ( !empty($facebook_share_url) ): ?>
        	    <li class="social-sharing__item <?php if(!empty($modifiers)): ?><?php echo esc_attr($modifiers); endif; ?>">
        	        <a class="social-sharing__link" href="<?php echo esc_url( $facebook_share_url ); ?>" <?php Extras\link_open_new_tab_attrs(); ?>>
    	                <?php echo Utils\ob_load_template_part('templates/partials/shared/icon', array(
    	                    'icon' => 'facebook',
    	                    'classnames' => 'social-sharing__icon svg-icon--ink'
    	                ));?>
        	        </a>
        	    </li>
            <?php endif; ?>
            <?php if ( !empty($twitter_share_url) ): ?>
        	    <li class="social-sharing__item social-sharing__item--twitter <?php if(!empty($modifiers)): ?><?php echo esc_attr($modifiers); endif; ?>">
        	        <a class="social-sharing__link" href="<?php echo esc_url( $twitter_share_url ); ?>" <?php Extras\link_open_new_tab_attrs(); ?>>
        	            <div class="social-sharing__icon-container">
        	                <?php echo Utils\ob_load_template_part('templates/partials/shared/icon', array(
        	                    'icon' => 'twitter',
        	                    'classnames' => 'social-sharing__icon svg-icon--ink'
        	                ));?>
        	            </div>
        	        </a>
        	    </li>
            <?php endif; ?>
            <?php if ( !empty($linkedin_share_url) ): ?>
        	    <li class="social-sharing__item social-sharing__item--linkedin <?php if(!empty($modifiers)): ?><?php echo esc_attr($modifiers); endif; ?>">
        	        <a href="<?php echo esc_url( $linkedin_share_url ); ?>" <?php Extras\link_open_new_tab_attrs(); ?>>
        	            <div class="social-sharing__icon-container">
        	                <?php echo Utils\ob_load_template_part('templates/partials/shared/icon', array(
        	                    'icon' => 'linked-in',
        	                    'classnames' => 'social-sharing__icon svg-icon--ink'
        	                ));?>
        	            </div>
        	        </a>
        	    </li>
            <?php endif; ?>
    	</ul>
    </div>
