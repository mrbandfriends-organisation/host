<?php
  use Roots\Sage\Utils;

  // Use minified versions for Production envs. Requires
  // gulp build
  $ext = ( WP_ENV === 'production' || WP_ENV === 'staging' ) ? 'min.' : '';

  $app_js_buster = Utils\cache_bust_asset( get_stylesheet_directory() . '/assets/js/dist/app.' . $ext . 'js' );
  $appjs = get_stylesheet_directory_uri() . '/assets/js/dist/app.' . $ext . 'js';
?>

<script>
if('querySelector' in document && 'localStorage' in window && 'addEventListener' in window) {
  // Load core JS
  function loadJS( src, cb ){
    "use strict";
    var ref = window.document.getElementsByTagName( "script" )[ 0 ];
    var script = window.document.createElement( "script" );
    script.src = src;
    script.async = true;
    ref.parentNode.insertBefore( script, ref );
    if (cb && typeof(cb) === "function") {
      script.onload = cb;
    }
    return script;
  }

  loadJS( "<?php echo $appjs; ?>" );
}
</script>
