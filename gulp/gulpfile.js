var gulp = require('gulp');
var imagemin = require('gulp-imagemin');

gulp.task('imagemin', function() {
  return gulp.src('image/**')
    .pipe(imagemin({
      progressive: true
    }))
    .pipe(gulp.dest('asset'))
});

gulp.task('default', ['imagemin']);
