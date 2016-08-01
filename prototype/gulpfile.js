/* jshint strict:false */

// ==========================================================================
// # DEPENDENCIES
// ==========================================================================

// gulp
var gulp         = require('gulp');
var errorHandler = require('./assets/gulp/errorHandler');
var php2html     = require('gulp-php2html');
require('frontend-boilerplate-assets');

// ==========================================================================
// # PATHS
// ==========================================================================

var paths = require('./assets/gulp/paths');

// ==========================================================================
// # TASKS
// ==========================================================================

// include submodules
require('require-dir')('./assets/gulp/tasks');

// # WATCH
// ==========================================================================
gulp.task('watch', function()
{
    gulp.watch([paths.sass.watch],  ['sass-watch']);
    gulp.watch([paths.js.watch  ],  ['js-watch']);
    gulp.watch([paths.svg.watch.sprite, paths.svg.watch.standalone], ['svg-watch']);
});

gulp.task('default', ['watch']);

// # Clean
// ==========================================================================
gulp.task('clean', function()
{
    require('del')( 'dist/**/*' );
});


// # HTML build
// ==========================================================================
gulp.task('php2html', function ()
{
    var plumber  = require('gulp-plumber');

    // build pages
    gulp.src( 'index.php' )
        .pipe( php2html() )
        .pipe( gulp.dest("./dist") );
});

// # BUILD
// ==========================================================================
gulp.task('build', function() {
    isBuild = true;

    // Run each task in sync (supposedly...not perfect but...)
    require('run-sequence')(
        'clean',
        'sass',
        'javascripts',
        'imagemin',
        'svg-watch',
        'php2html',
        function()
        {
            // copy assets
            gulp.src([
                'assets/css/**/*',
                'assets/js/dist/**/*',
                'assets/fonts/**/*',
                'assets/images/**/*',
                'assets/svg/**/*'
            ], { base: 'assets' })
                .pipe(gulp.dest('./dist/assets'));
        }
    );
});
