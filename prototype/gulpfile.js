/* jshint strict:false */

// ==========================================================================
// # DEPENDENCIES
// ==========================================================================

var browserSync             = require('browser-sync').create();
var runSequence             = require('run-sequence');
var pngquant                = require('imagemin-pngquant');
var path                    = require("path");

var gulp                    = require('gulp');
var env                     = require('gulp-env');
var rename                  = require("gulp-rename");
var plumber                 = require('gulp-plumber');
var notify                  = require("gulp-notify");


var sass                    = require('gulp-sass');
var scsslint                = require('gulp-scss-lint');
var pixrem                  = require('gulp-pixrem');
var cssmin                  = require('gulp-cssmin');
var autoprefixer            = require('gulp-autoprefixer');
var sourcemaps              = require('gulp-sourcemaps');

var imagemin                = require('gulp-imagemin');

var jshint                  = require('gulp-jshint');
var stylish                 = require('jshint-stylish');

var svgmin                  = require('gulp-svgmin');
var svgstore                = require('gulp-svgstore');
var svg2png                 = require('gulp-svg2png');
var php2html                = require("gulp-php2html");

var webpack                 = require('webpack');
var gulpWebpack             = require('webpack-stream');
var CleanWebpackPlugin      = require('clean-webpack-plugin');

var transform               = require('vinyl-transform');
var source                  = require('vinyl-source-stream');
var buffer                  = require('vinyl-buffer');

var bourbon                 = require('node-bourbon');





// ==========================================================================
// # VARS
// ==========================================================================

var isBuild                 = false;


// ==========================================================================
// # CONSTANTS
// ==========================================================================

var basePath                = "./";
var assetsDir               = basePath + 'assets/';

var cssSrcDir               = basePath + 'assets/sass';
var cssSrcFiles             = cssSrcDir + '/**/*.scss';
var cssDestDir              = basePath + 'assets/css';
var cssDestFiles            = cssDestDir + '/*.css';

var jsSrcDir                = assetsDir + 'js/src';
var jsSrcFiles              = jsSrcDir + '/**/*';
var jsDestDir               = assetsDir + 'js/dist';

var imagesDir               = basePath + 'assets/images';
var imagesFiles             = imagesDir + '/**/*';

var svgDir                  = basePath + 'assets/svg';
var svgFiles                = [svgDir + '/*.svg', svgDir + '/sprites/*.svg'];


// ==========================================================================
// # TASKS
// ==========================================================================

// # ERROR HANDLER
// ==========================================================================

var errorHandler = function(err) {
    notify.onError({
        title:    "Frontend Boilerplate Notification",
        subtitle: "Error!",
        message:  "<%= error.message %> - <%= error.fileName %> - <%= error.lineNumber %>",
        sound:    "Beep"
    })(err);

    this.emit('end');
};

// # ENV VARS
// ==========================================================================

gulp.task('set-env', function () {
    env({
        file: ".env.json",
    });
});

// # BROWSER SYNC
// ==========================================================================

// Static server
gulp.task('browser-sync', function() {
    browserSync.init({
        proxy: process.env.root_url
    });
});


// # CSS
// ==========================================================================

gulp.task('css', function() {
    gulp.src(cssSrcFiles)
        .pipe(plumber({
            errorHandler: errorHandler
        }))
        .pipe(sourcemaps.init())
        .pipe(sass({
            includePaths: bourbon.includePaths
        }))
        .pipe(pixrem())
        .pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest(cssDestDir))
        .pipe(notify({ 
            title: 'Frontend Boilerplate Notification',
            subtitle: 'Sass task complete',
            message: 'CSS successfully compiled.'
        })
    );
});


// Dedicated watch task to facilitate easy Browser Sync livereloading
gulp.task('css-watch', ['css', 'scss-lint']);


// Lint SCSS
gulp.task('scss-lint', function() {
    gulp.src(cssSrcFiles)
        .pipe(plumber({
            errorHandler: errorHandler
        }))
        .pipe( scsslint({
            'config': 'scss-lint.yml',
            'bundleExec': true
    }));
});


// Minify output
gulp.task('cssmin', ['css'], function () {
    gulp.src([cssDestDir + '/app.css', cssDestDir + '/app-oldie.css'])
        .pipe(plumber({
            errorHandler: errorHandler
        }))
        .pipe(cssmin())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest(cssDestDir + '/'));
});

// Apply prefixes to older browsers
gulp.task('autoprefixer', function () {
    return gulp.src(cssDestDir + '/*.css')
        .pipe(plumber({
            errorHandler: errorHandler
        }))
        .pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
        .pipe(gulp.dest(cssDestDir + '/'));
});



// # JAVASCRIPT
// ==========================================================================

gulp.task('javascripts', function() {
    return gulp.src(jsSrcDir + '/app.js')
        .pipe(plumber({
            errorHandler: errorHandler
        }))
        .pipe(jshint({
            lookup: true
        }))
        .pipe(jshint.reporter(stylish))
        .pipe(gulpWebpack({ // webpack-stream for using Webpack with Gulp streams
            output: {
                //path: "./assets/js/",
                publicPath: "/app/themes/ssetelecoms/assets/js/dist/",
                filename: "app.js",
                chunkFilename: "chunk-[name].[chunkhash].js" // generate one hash per chunk to enable cache busting on change
            },
            plugins: [
                new webpack.optimize.UglifyJsPlugin({
                    compressor: {
                        warnings: false,
                    },
                }),
                new webpack.ProvidePlugin({ // inject globals as required
                    $: "jquery",
                    jQuery: "jquery",
                }),
                new webpack.optimize.OccurrenceOrderPlugin(),
                new CleanWebpackPlugin(['dist'], {
                  root: __dirname + '/assets/js/',
                  verbose: true,
                  dry: false
                })
            ],
            amd: {
                jQuery: true
            },
            resolve: {
                root: __dirname,
                modulesDirectories: ['lib','vendor', 'node_modules']
            }
        },webpack)) // 2nd argument allows us to inh=ject a custom version of webpack into the webpack-stream lib
        .pipe(gulp.dest(jsDestDir))
        .pipe(notify({ 
            title: 'Frontend Boilerplate Notification',
            subtitle: 'Javascripts task complete',
            message: 'JavaScript successfully compiled.'
        }));
});


// # JSHINT
gulp.task('jshint', function() {
    return gulp.src( [
        'gulpfile.js',
        jsSrcDir + '/app.js'
    ] )
    .pipe(plumber({
            errorHandler: errorHandler
        }))
    .pipe(jshint({
        lookup: true
    }))
    .pipe(jshint.reporter(stylish));
});

// Dedicated watch task to facilitate easy Browser Sync livereloading
gulp.task('js-watch', ['javascripts'], browserSync.reload);



// # IMAGES
// ==========================================================================

// Image Optimisation
gulp.task('imagemin', function () {
    return gulp.src([
        imagesFiles,
        '!assets/images/svg/**/*' // don't touch my SVGs
    ])
    .pipe(plumber({
            errorHandler: errorHandler
        }))
    .pipe(imagemin({
        progressive: true,
        svgoPlugins: [], // don't touch my SVGs
        use: [pngquant()]
    }))
    .pipe(gulp.dest(imagesDir))
    .pipe(notify({ 
        title: 'Frontend Boilerplate Notification',
        subtitle: 'Image minification task complete',
        message: 'Add Images successfully optimised.'
    }));
});


// # SVG
// ==========================================================================

// SVG SPRITE
// combines all SVGs found within the /sprites/ dir
// into a single sprite map which is then loaded via
// XHR into the DOM and referenced via <use> in SVG
// SVG For Everybody is then used to provide fallback
// PNG images (see below)
gulp.task('svgsprite', function() {
  return gulp.src( svgDir + '/sprites/*.svg' )
    .pipe(plumber({
            errorHandler: errorHandler
        }))
    .pipe(svgstore({
        fileName: 'spritesheet.svg',
        prefix: 'icon-',
        cleanup: ['fill', 'style'],
        cleanupdefs: true
    }))
    .pipe(svgmin({
      plugins: [{
          removeDoctype: true
      }, {
          cleanupIDs: false
      }]
    }))
    .pipe(gulp.dest( svgDir + '/sprites/output'));
});

gulp.task('svgstandalone', function() {
  return gulp.src( svgDir + '/standalone/*.svg' )
    .pipe(plumber({
            errorHandler: errorHandler
        }))
    .pipe(svgmin({
      plugins: [{
          removeDoctype: true
      }, {
          cleanupIDs: true
      }]
    }))
    .pipe(gulp.dest( svgDir + '/standalone/output'));
});

// SVG FALLBACK PNGS
// creates PNG clones of all SVG sprite images
// use https://github.com/jonathantneal/svg4everybody
// to modify DOM to show fallbacks
gulp.task('svg2png', function () {
    gulp.src(svgDir + '/sprites/*.svg')
    .pipe(plumber({
        errorHandler: errorHandler
    }))
    .pipe(svg2png())
    .pipe(gulp.dest(svgDir + '/sprites/output/png'))
    .pipe(notify({ 
        title: 'Frontend Boilerplate Notification',
        subtitle: 'SVG Sprite task complete',
        message: 'SVG sprites successfully created.'
    }));
});


gulp.task('svg2pngstandalone', function () {
    gulp.src(svgDir + '/standalone/output/*.svg')
        .pipe(plumber({
            errorHandler: errorHandler
        }))
        .pipe(svg2png())
        .pipe(gulp.dest(svgDir + '/standalone/output/png'));
});

gulp.task('svg-watch', ['svgsprite','svg2png', 'svgstandalone', 'svg2pngstandalone']);



// # STATIC SITE GENERATOR :)
// ==========================================================================

gulp.task('php2html', function () {
    gulp.src("./index.php")
    .pipe(plumber({
        errorHandler: errorHandler
    }))
    .pipe(php2html())
    .pipe(gulp.dest("./dist"));
});


// ==========================================================================
// # CORE TASKS
// ==========================================================================

// # WATCH
// ==========================================================================
gulp.task('watch', ['set-env','browser-sync'], function() {
    gulp.watch([cssSrcFiles], ['css-watch']);
    gulp.watch([ jsSrcFiles ], ['js-watch']);
    gulp.watch([svgFiles], ['svg-watch']);
});

// # BUILD
// ==========================================================================
gulp.task('build', function() {
    isBuild = true;

    // Run each task in sync (supposedly...not perfect but...)
    runSequence(
        'scss-lint',
        'cssmin', // 'css' - not called explicitly as cssmin defines "css" task as dependency
        'javascripts',
        'imagemin',
        'svg-watch',
        'php2html'

    );
});

gulp.task('default', ['watch']);
