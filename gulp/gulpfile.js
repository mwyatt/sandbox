var gulp = require('gulp');
var postcss = require('gulp-postcss');
var csswring = require('csswring');
var autoprefixer = require('autoprefixer-core');
var customProperties = require('postcss-custom-properties');
var atImport = require('postcss-import');
var mixins = require('postcss-mixins');
var colorFunction = require("postcss-color-function")
var uglify = require('gulp-uglify');

var css = ['./css/**/*.css', '!./css/**/_*.css'];
var processes = [
  atImport(),
  customProperties(),
  colorFunction(),
  mixins(),
  autoprefixer({browsers: ['last 1 version']})
];

var action = {
  postcss: function() {
    return gulp.src(css)
      .pipe(postcss(processes))
      .pipe(gulp.dest('asset'));
  }
}

gulp.task('css', function () {
  return action.postcss();
});

gulp.task('cssm', function () {
  process.push(csswring);
  return action.postcss();
});

gulp.task('jsm', function() {
  return gulp.src('asset/**/*.js')
    .pipe(uglify())
    .pipe(gulp.dest('asset'));
});
