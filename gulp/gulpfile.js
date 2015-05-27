var gulp = require('gulp');

// post css processor
var postcss = require('gulp-postcss');

  // css minify
  var csswring = require('csswring');

  // transition:
  var autoprefixer = require('autoprefixer-core');

  // --foo-bar
  var cssvariables = require('postcss-css-variables');

  // @import
  var atImport = require('postcss-import');

  var assets  = require('postcss-assets');


var postcssProcessors = [
  atImport,
  cssvariables,
  autoprefixer({browsers: ['last 1 version']}),
  assets({
    relativeTo: 'asset/',
    loadPaths: ['asset/']
  })
];

// css bundle files
var css = ['./css/**/*.css', '!./css/**/_*.css'];

function doPostCss () {
  return gulp.src(css)
    .pipe(postcss(postcssProcessors))
    .pipe(gulp.dest('./asset'))
}

// css build
gulp.task('css', function () {
  return doPostCss();
});

// css build minify
gulp.task('cssm', function () {
  postcssProcessors.push(csswring);
  return doPostCss();
});

// js minify
