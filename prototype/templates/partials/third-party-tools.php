<?php 
/**
 * GOOGLE ANALYTICS
 * if on non-production environments we don't want to be 
 * tracking events into GA directly. As a result we use 
 * a mock GA implementation to test calls to GA
 */
if ( !empty($google_analytics_code) ): ?>
<script>
    <?php if ( $environment === "production" ) : ?>
        (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
        function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
        e=o.createElement(i);r=o.getElementsByTagName(i)[0];
        e.src='https://www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
        ga('create','<?php echo $google_analytics_code; ?>','auto');ga('send','pageview');
    <?php else : ?>
        if (window.console) {
            console.log("Google Analytics installed and running in test mode with code: <?php echo $google_analytics_code; ?>");
        }
        function ga() {
            if (window.console) {
                console.log('Google Analytics: ' + [].slice.call(arguments));
            }
        }
    <?php endif; ?>
</script>
<?php endif; ?>


<?php 
/**
 * BUGHERD
 * used as an issue tracker for snagging and client feedback.
 * Only included on non-production environments (obviously...)
 */
if ( !empty($bugherd_api_key) && $environment !== "production" ) : ?>
    <script type='text/javascript'>
    (function (d, t) {
      var bh = d.createElement(t), s = d.getElementsByTagName(t)[0];
      bh.type = 'text/javascript';
      bh.src = '//www.bugherd.com/sidebarv2.js?apikey=' + <?php echo $bugherd_api_key; ?>;
      s.parentNode.insertBefore(bh, s);
      })(document, 'script');
    </script>
<?php endif; ?>