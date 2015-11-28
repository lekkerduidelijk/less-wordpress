/**
 * Gulp File
 *
 * @author: Rutger Laurman - lekkerduidelijk.nl
 * @url: https://github.com/lekkerduidelijk/gulp-template
 *
 * @TODO:
 * - Add media task
 * - Add UnCSS task
 * - Make testing more DRY
 * - Investigate subtasks / separate files
 */

/* ==========================================================================
   Load dependencies
   ========================================================================== */
var gulp    = require('gulp'),
    plugins = require('gulp-load-plugins')(),
    pkg     = require('./package.json');

// Gulp header config
var banner = ['/*!',
  ' * <%= pkg.name %>',
  ' * @author: <%= pkg.author %>',
  ' * @date:   <%= new Date().getDate() %>-<%= new Date().getMonth()+1 %>-<%= new Date().getFullYear() %>',
  ' */',
  ''].join('\n');

// Temporary solution until gulp 4
// https://github.com/gulpjs/gulp/issues/355
var runSequence = require('run-sequence');

/* ==========================================================================
   Helper tasks
   ========================================================================== */

/* Stylesheets
   ========================================================================== */

// Stylesheets
gulp.task('less', function () {
  return gulp.src('less/style.less', { base: './' })

  // Notify on error
  .pipe(plugins.plumber({errorHandler: plugins.notify.onError("LESS: <%= error.message %>")}))

  // Less + sourcemap
  .pipe(plugins.sourcemaps.init({
    debug: true
  }))
  .pipe(plugins.less())
  .pipe(plugins.sourcemaps.write())

  // Autoprefixer
  .pipe(plugins.autoprefixer())
  .pipe(plugins.rename('style.full.css'))
  .pipe(gulp.dest('css/'))

  // Minify
  .pipe(plugins.minifyCss({
    keepSpecialComments: '0'
  }))
  .pipe(plugins.rename('style.css'))
  .pipe(gulp.dest('css/'))

  // Header / banner
  .pipe(plugins.header(banner, { pkg: pkg }))
  .pipe(gulp.dest('css/'))

  // Livereload
  .pipe(plugins.livereload())

  // Notify
  .pipe(plugins.notify("LESS complete"));

});


// Stylesheets test
gulp.task('less:test', function () {
  return gulp.src('less/style.less', { base: './' })

  // Less + sourcemap
  .pipe(plugins.sourcemaps.init({
    debug: true
  }))
  .pipe(plugins.less())
  .pipe(plugins.sourcemaps.write())

  // Autoprefixer
  .pipe(plugins.autoprefixer())

  // Minify
  .pipe(plugins.minifyCss({
    keepSpecialComments: '0'
  }))

  // Header / banner
  .pipe(plugins.header(banner, { pkg: pkg }));

});

/* Javascripts
   ========================================================================== */

gulp.task('js', function(){
  return gulp.src('js/app.js')

  // Notify on error
  .pipe(plugins.plumber({errorHandler: plugins.notify.onError("JS: <%= error.message %>")}))

  // Include files
  .pipe(plugins.include())
  .pipe(plugins.rename('app.full.js'))
  .pipe(gulp.dest('js/'))

  // Uglify
  .pipe(plugins.uglify())
  .pipe(plugins.rename('app.min.js'))
  .pipe(gulp.dest('js/'))

  // Header / banner
  .pipe(plugins.header(banner, { pkg: pkg }))
  .pipe(gulp.dest('js/'))

  // Livereload
  .pipe(plugins.livereload())

  // Notify
  .pipe(plugins.notify("JS complete"));

});

// javascript test

gulp.task('js:test', function(){
  return gulp.src('js/app.js')

  // Include files
  .pipe(plugins.include())

  // Uglify
  .pipe(plugins.uglify())

  // Header / banner
  .pipe(plugins.header(banner, { pkg: pkg }));

});


/* Watch
   ========================================================================== */

gulp.task('watch', function () {
  plugins.livereload.listen();

  gulp.watch(['js/**/*.js', '!js/app.min.js', '!js/app.full.js'], ['js']);
  gulp.watch('less/**/*.less', ['less']);
});

/* ==========================================================================
   Main tasks
   ========================================================================== */

/* Default
   ========================================================================== */

gulp.task('default', function (done){
  runSequence('build', 'watch', done);
});

/* Test
   ========================================================================== */

gulp.task('test', function (done){
  runSequence('less:test', 'js:test', done);
});

/* Build
   ========================================================================== */

gulp.task('build', function (done) {
    runSequence(
      ['less', 'js'],
      done);
});
