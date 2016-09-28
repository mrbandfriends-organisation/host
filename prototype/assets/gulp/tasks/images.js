var gulp         = require('gulp');
var plumber      = require('gulp-plumber');
var imagemin     = require('gulp-imagemin');
var pngquant     = require('imagemin-pngquant');
var paths        = require('../paths');
var errorHandler = require('../errorHandler');

// Image Optimisation
gulp.task('imagemin', function ()
{
    return  gulp.src( paths.images.source )
                .pipe(plumber({
                    errorHandler: errorHandler
                }))
                .pipe(imagemin({
                    progressive: true,
                    svgoPlugins: [], // don't touch my SVGs
                    use: [ pngquant() ]
                }))
                .pipe(gulp.dest( paths.images.output ));
});
