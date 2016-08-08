<script>
    <?php // Super fast JS-ready ?>
    document.documentElement.className = document.documentElement.className.replace(/(\s|^)no-js(\s|$)/, '$1js$2');

    <?php // Super fast "Cuts the Mustard" test ?>
    if('querySelector' in document && 'localStorage' in window && 'addEventListener' in window) {
        // Add HTML class
        if (document.documentElement.classList) {
            document.documentElement.classList.add('cuts-the-mustard');
            document.documentElement.classList.remove('no-cuts-the-mustard');
        } else {
            document.documentElement.className += ' cuts-the-mustard';
            // Reliable way of removing a class in olde browsers
            document.documentElement.className = document.documentElement.className.replace(new RegExp('(^|\\b)' + 'no-cuts-the-mustard'.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
        }
    }
</script>
