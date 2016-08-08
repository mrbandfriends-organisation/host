var path = require('path');
var root = path.resolve(__dirname+'/..');

module.exports = {
    boilerplate: root,
    sass: {
        watch:   root+'/sass/**/*.scss',
        source: [root+'/sass/*.scss', '!'+root+'/sass/_*.scss'],
        output:  root+'/css'
    },
    js: {
        watch:  root+'/js/src/**/*.js',
        source: root+'/js/src/app.js',
        output: root+'/js/dist/',
        root:   root+'/js/'
    },
    images: {
        watch:  root+'/images/**/*',
        source: root+'/images/**/*',
        output: root+'/images/'
    },
    svg: {
        watch:  {
            sprite:     [ root+'/svg/sprites/**/*.svg',    '!'+root+'/svg/sprites/output/**/*' ],
            standalone: [ root+'/svg/standalone/**/*.svg', '!'+root+'/svg/standalone/output/**/*' ]
        },
        source: {
            sprite:     [ root+'/svg/sprites/**/*.svg',    '!'+root+'/svg/sprites/output/**/*' ],
            standalone: [ root+'/svg/standalone/**/*.svg', '!'+root+'/svg/standalone/output/**/*' ]
        },
        output: {
            sprite:     root+'/svg/sprites/output/',
            standalone: root+'/svg/standalone/output/',
        }
    }
};
