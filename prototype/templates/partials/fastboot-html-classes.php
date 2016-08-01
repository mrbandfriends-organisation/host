<script>
    <?php // Super fast JS-ready ?>
    document.documentElement.className = document.documentElement.className.replace(/(\s|^)no-js(\s|$)/, '$1js$2');
    
    <?php // Super fast "Cuts the Mustard" test ?>
    if('querySelector' in document && 'localStorage' in window && 'addEventListener' in window) {
        // Add HTML class
        if (document.documentElement.classList) {
          document.documentElement.classList.add('cuts-the-mustard');
        } else {
          document.documentElement.className += ' cuts-the-mustard';
        }
    } else {
        if (document.documentElement.classList) {
            document.documentElement.classList.add('no-cuts-the-mustard');
        } else {
            document.documentElement.className += ' no-cuts-the-mustard';
        }
    }
</script> 