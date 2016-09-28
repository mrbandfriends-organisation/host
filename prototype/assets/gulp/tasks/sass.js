// ==========================================================================
// # SASS-functions
// ==========================================================================
var gulp         = require('gulp');
var plumber      = require('gulp-plumber');
var sassGlob     = require('gulp-sass-glob');
var sass         = require('gulp-sass');
var postcss      = require('gulp-postcss');
var rename       = require('gulp-rename');
var sourcemaps   = require('gulp-sourcemaps');
var scsslint     = require('gulp-scss-lint');
var bourbon      = require('node-bourbon');
var paths        = require('../paths');
var errorHandler = require('../errorHandler');

// SASS compilation
gulp.task('sass', function()
{
    return  gulp.src( paths.sass.source )
                .pipe(plumber({
                    errorHandler: errorHandler
                }))
                .pipe(sassGlob())
                // .pipe(sourcemaps.init())
                .pipe(sass({
                    includePaths: bourbon.includePaths,
                    outputStyle:  'expanded'
                }))
                .pipe(postcss([
                    require('autoprefixer')({ browsers: [ 'last 2 versions' ]}),
                    require('css-mqpacker')({ sort: true })
                ]))
                // .pipe(sourcemaps.write())
                .pipe(gulp.dest( paths.sass.output ))
                .pipe(postcss([
                    require('postcss-sorting'),
                    require('cssnano')({
                        safe: true,
                        autoprefixer: false,
                        orderedValues: false
                    })
                ]))
                .pipe(rename({ suffix: '.min' }))
                .pipe(gulp.dest( paths.sass.output ));
});

// SASS linting
gulp.task('sass-lint', function() {
    return  gulp.src( paths.sass.watch )
                .pipe(plumber({
                    errorHandler: errorHandler
                }))
                .pipe( scsslint({
                    'config': paths.boilerplate+'/.scss-lint.yml',
                    'bundleExec': true
                }));
});

// delegate watch task
gulp.task('sass-watch', [ 'sass', 'sass-lint' ]);
