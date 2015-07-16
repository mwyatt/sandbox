var pkg = require('./package.json');
var gulp = require('gulp');
var postcss = require('gulp-postcss');
var csswring = require('csswring');
var autoprefixer = require('autoprefixer-core');
var customProperties = require('postcss-custom-properties');
var atImport = require('postcss-import');
var mixins = require('postcss-mixins');
var colorFunction = require("postcss-color-function")
var uglify = require('gulp-uglify');
var imagemin = require('gulp-imagemin');
var source     = require('vinyl-source-stream');
var browserify = require('browserify');
var es         = require('event-stream');
var glob       = require('glob');
var runSequence = require('run-sequence');


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

gulp.task('js/copy', function() {
  gulp.src('app/site/' + pkg.name + '/js/**/**.js')
    .pipe(gulp.dest('js'));
});

// copy all files from codex
// copy all files from site
// move to js/
gulp.task('js', function() {
  runSequence('js/copy', 'js/browserify');
});

gulp.task('js/browserify', function(done) {
  glob('js/**/**.bundle.js', function(err, files) {
    if(err) done(err);

    // map them to our stream function
    var tasks = files.map(function(entry) {
      return browserify({
        entries: [entry],
        paths: ['node_modules', 'js']
      })
      .bundle()
      .pipe(source(entry))
      .pipe(uglify())
      .pipe(gulp.dest('asset')); 
    });

    // create a merged stream
    es.merge(tasks).on('end', done);
  });
});
