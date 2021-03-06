<?php

namespace Roots\Sage\Tracking;

use Roots\Sage\Utils;


/**
 * ADD GOOGLE TAG MANAGER CODE
 */
function google_tag_manager_code() {?>
  <?php if ( defined( 'GOOGLE_TAG_MANAGER_CODE' ) && !empty( GOOGLE_TAG_MANAGER_CODE )) { ?>
    <?php if ( defined( 'WP_ENV' ) && WP_ENV == "production" ) { ?>
      <!-- Google Tag Manager Production -->
      <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
      new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
      j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
      'https://www.googletagmanager.com/gtm.js?id='+i+dl+ '&gtm_auth=imNm4KlIB5ZQxCkb-5E3Fw&gtm_preview=env-2&gtm_cookies_win=x';f.parentNode.insertBefore(j,f);
      })(window,document,'script','dataLayer','<?php echo GOOGLE_TAG_MANAGER_CODE ?>');</script>
      <!-- End Google Tag Manager -->
    <?php } ?>

    <?php if ( defined( 'WP_ENV' ) && WP_ENV == "staging" ) { ?>
      <!-- Google Tag Manager Staging -->
      <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
      new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
      j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
      'https://www.googletagmanager.com/gtm.js?id='+i+dl+ '&gtm_auth=P4gMawTUaOk09rDHtmd1-A&gtm_preview=env-80&gtm_cookies_win=x';f.parentNode.insertBefore(j,f);
      })(window,document,'script','dataLayer','<?php echo GOOGLE_TAG_MANAGER_CODE ?>');</script>
      <!-- End Google Tag Manager -->
    <?php } ?>
  <?php } ?>
<?php
}
add_action('wp_head', __NAMESPACE__ . '\\google_tag_manager_code', 0);

function google_tag_manager_no_script_code() { ?>
  <?php if ( defined( 'GOOGLE_TAG_MANAGER_CODE' ) && !empty( GOOGLE_TAG_MANAGER_CODE )) { ?>
    <?php if ( defined( 'WP_ENV' ) && WP_ENV == "production" ) { ?>
      <!-- Google Tag Manager (noscript) -->
      <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo GOOGLE_TAG_MANAGER_CODE ?>&gtm_auth=imNm4KlIB5ZQxCkb-5E3Fw&gtm_preview=env-2&gtm_cookies_win=x"
      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
      <!-- End Google Tag Manager (noscript) -->
    <?php } ?>
    
    <?php if ( defined( 'WP_ENV' ) && WP_ENV == "staging" ) { ?>
      <!-- Google Tag Manager (noscript) -->
      <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo GOOGLE_TAG_MANAGER_CODE ?>&gtm_auth=P4gMawTUaOk09rDHtmd1-A&gtm_preview=env-80&gtm_cookies_win=x"
      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
      <!-- End Google Tag Manager (noscript) -->
    <?php } ?>
  <?php } ?>
<?php
}
add_action('after_body', __NAMESPACE__ . '\\google_tag_manager_no_script_code', 0);


/**
 * ADD GOOGLE ANALYTICS CODE
 */
function google_analytics_code() {
    if ( defined( 'GOOGLE_ANALYTICS_CODE' ) && !empty( GOOGLE_ANALYTICS_CODE ) ): ?>
    <?php
    $urls = [];
    while ( have_rows('trackable_external_urls', 'option') ) : the_row();
        array_push($urls, esc_html(get_sub_field('url')));
    endwhile;?>

     <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', '<?= GOOGLE_ANALYTICS_CODE; ?>', 'auto', {'allowLinker': true});
        ga('require', 'linker');
        ga('linker:autoLink', <?=json_encode($urls); ?> );
        ga('send', 'pageview');

      </script>
    <?php endif; ?>
<?php
}
add_action('wp_head', __NAMESPACE__ . '\\google_analytics_code', 19);
