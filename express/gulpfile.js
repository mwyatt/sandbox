var gulp = require('gulp');
var browserify = require('browserify');
var source = require('vinyl-source-stream');
var es = require('event-stream');
var glob = require('glob');

gulp.task('js', function(done) {
  glob('common.bundle.js', function(err, files) {
    if (err) {
      done(err);
    };
    var tasks = files.map(function(entry) {
      return browserify({
        entries: [entry],
        paths: ['node_modules']
      })
      .bundle()
      .pipe(source(entry.replace('.bundle', '')))
      .pipe(gulp.dest('.'));
    });

    // create a merged stream
    es.merge(tasks).on('end', done);
  });
});