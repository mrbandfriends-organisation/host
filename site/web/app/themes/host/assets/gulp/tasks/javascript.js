// # JAVASCRIPT
// ==========================================================================

var gulp                = require('gulp');
var plumber             = require('gulp-plumber');
var jshint              = require('gulp-jshint');
var stylish             = require('jshint-stylish');
var webpack             = require('webpack');
var gulpWebpack         = require('webpack-stream');
var CleanWebpackPlugin  = require('clean-webpack-plugin');
var errorHandler        = require('../errorHandler');
var paths               = require('../paths');

gulp.task('javascripts', function() {
    return  gulp.src( paths.js.source )
                .pipe(plumber({
                    errorHandler: errorHandler
                }))                
                .pipe(gulpWebpack({ // webpack-stream for using Webpack with Gulp streams
                    entry: {
                        "app": paths.js.sourceDir + 'app.js',
                        //"app.min": paths.js.sourceDir + 'app.js'
                    },
                    output: {
                        //path: "./assets/js/",
                        publicPath: "/app/themes/host/assets/js/dist/",
                        filename: "[name].js",
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
                          root: paths.js.root,
                          verbose: true,
                          dry: false
                        })
                    ],
                    amd: {
                        jQuery: true
                    },
                    resolve: {
                        root: __dirname,
                        modulesDirectories: ['lib', 'vendor', 'node_modules', 'ui']
                    }
                },webpack)) // 2nd argument allows us to inject a custom version of webpack into the webpack-stream lib
                .pipe(gulp.dest( paths.js.output ))

});


// # JSHINT
gulp.task('jshint', function()
{
    return  gulp.src( paths.js.watch )
                .pipe(plumber({
                    errorHandler: errorHandler
                }))
                .pipe(jshint({
                    lookup: true
                }))
                .pipe(jshint.reporter(stylish));
});


gulp.task('js-watch', ['javascripts', 'jshint']);
