/* jshint strict:false */

// ==========================================================================
// # DEPENDENCIES
// ==========================================================================

// gulp
var gulp   = require('gulp');
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
