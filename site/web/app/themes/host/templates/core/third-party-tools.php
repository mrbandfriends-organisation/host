<?php
/**
 * BUGHERD
 * used as an issue tracker for snagging and client feedback.
 * Only included on non-production environments (obviously...)
 */

if ( defined('BUGHERD_API_KEY') && !empty( BUGHERD_API_KEY ) && ( WP_ENV !== 'production' ) ): ?>
    <script type='text/javascript'>
    (function (d, t) {
      var bh = d.createElement(t), s = d.getElementsByTagName(t)[0];
      bh.type = 'text/javascript';
      bh.src = '//www.bugherd.com/sidebarv2.js?apikey=<?php echo BUGHERD_API_KEY; ?>';
      s.parentNode.insertBefore(bh, s);
      })(document, 'script');
    </script>
<?php endif; ?>



