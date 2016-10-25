<script>
    <?php // Super fast JS-ready ?>
    document.documentElement.className = document.documentElement.className.replace(/(\s|^)no-js(\s|$)/, '$1js$2');

    <?php // Super fast "Cuts the Mustard" test ?>
    if('querySelector' in document && 'localStorage' in window && 'addEventListener' in window) {
        // Add HTML class
        if (document.documentElement.classList) {
            document.documentElement.classList.add('enhanced');
            document.documentElement.classList.remove('unenhanced');
        } else {
            document.documentElement.className += ' enhanced';
            // Reliable way of removing a class in olde browsers
            document.documentElement.className = document.documentElement.className.replace(new RegExp('(^|\\b)' + 'unenhanced'.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
        }
    }
</script>
