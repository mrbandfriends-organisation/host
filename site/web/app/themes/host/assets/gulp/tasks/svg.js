// # SVG
// ==========================================================================

var gulp         = require('gulp');
var buffer       = require('gulp-buffer');
var plumber      = require('gulp-plumber');
var svgmin       = require('gulp-svgmin');
var svgstore     = require('gulp-svgstore');
var rename       = require('gulp-rename');
var svg2png      = require('gulp-svg2png');
var paths        = require('../paths');
var errorHandler = require('../errorHandler');

// SVG SPRITE
// combines all SVGs found within the /sprites/ dir
// into a single sprite map which is then loaded via
// XHR into the DOM and referenced via <use> in SVG
// SVG For Everybody is then used to provide fallback
// PNG images (see below)
gulp.task('svgsprite', function()
{
    return  gulp.src( paths.svg.source.sprite )
                .pipe(plumber({
                    errorHandler: errorHandler
                }))
                .pipe(rename({ prefix: 'icon-' }))
                .pipe(svgstore({
                    cleanup: ['fill', 'style'],
                    cleanupdefs: true
                }))
                .pipe(svgmin({
                    plugins: [
                        { removeDoctype: true },
                        { cleanupIDs: false }
                    ]
                }))
                .pipe(rename(paths.svg.output.spriteFile))
                .pipe(gulp.dest( paths.svg.output.sprite ));
});

gulp.task('svgstandalone', function()
{
    return  gulp.src( paths.svg.source.standalone )
                .pipe(plumber({
                    errorHandler: errorHandler
                }))
                .pipe(svgmin({
                    plugins: [
                        { removeDoctype: true },
                        { cleanupIDs: false }
                    ]
                }))
                .pipe(gulp.dest( paths.svg.output.standalone ));
});

/*
gulp.task('svg2pngstandalone', function () {
    gulp.src( paths.svg.output.standalone )
        .pipe(plumber({
            errorHandler: errorHandler
        }))
        .pipe(buffer())
        .pipe(svg2png())
        .pipe(gulp.dest( paths.svg.output.standalonepng ));
});
*/

gulp.task('svg-watch', [ 'svgsprite', 'svgstandalone' ]);
