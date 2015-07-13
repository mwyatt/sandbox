var gulp = require('gulp');
var browserify = require('gulp-browserify');
 
gulp.task('js', function() {
  gulp.src('js/common.js')
    .pipe(browserify({
      paths: ['node_modules','js/']
    }))
    .pipe(gulp.dest('asset'));
});

