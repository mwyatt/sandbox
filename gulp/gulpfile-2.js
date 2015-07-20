var pkg = require('./package.json');
var gulp = require('gulp');
var browserify = require('browserify');
var source = require('vinyl-source-stream');
var es = require('event-stream');
var glob = require('glob');
var uglify = require('gulp-uglify');
var runSequence = require('run-sequence');
var gutil = require('gulp-util');
var clean = require('gulp-clean');

gulp.task('clean', function () {  
  return gulp.src(['asset', 'js'], {read: false})
    .pipe(clean());
});

gulp.task('clean/js', function () {  
  return gulp.src(['js'], {read: false})
    .pipe(clean());
});

gulp.task('js/copy/admin', function() {
  return gulp.src('app/admin/js/**/**.js')
    .pipe(gulp.dest('js/admin'));
});

gulp.task('js/copy/site', function() {
  return gulp.src('app/site/' + pkg.name + '/js/**/**.js')
    .pipe(gulp.dest('js'));
});

gulp.task('js/copy/codex', function() {
  return gulp.src('app/site/codex/js/**/**.js')
    .pipe(gulp.dest('js'));
});

gulp.task('js/uglify', function() {
  gulp.src('asset/**/**.js')
    .pipe(uglify())
    .pipe(gulp.dest('asset'));
});

gulp.task('js/browserify', function(done) {
  glob('js/**/**.bundle.js', function(err, files) {
    if (err) {
      done(err);
    };
    var tasks = files.map(function(entry) {
      return browserify({
        entries: [entry],
        paths: ['node_modules', 'js']
      })
      .bundle()
      .pipe(source(entry.replace('js/', '')))
      .pipe(gulp.dest('asset'));
    });

    // create a merged stream
    es.merge(tasks).on('end', done);
  });
});

gulp.task('js', function() {
  runSequence(
    'clean',
    'js/copy/codex',
    'js/copy/admin',
    'js/copy/site',
    'js/browserify',
    'clean/js'
  );
});
