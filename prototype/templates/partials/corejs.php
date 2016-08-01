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

      loadJS( "<?=$this->asset('/assets/js/dist/app.min.js'); ?>" );
  } 
</script>