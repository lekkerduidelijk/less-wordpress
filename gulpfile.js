/**
 * Gulp File
 *
 * @author: Rutger Laurman - lekkerduidelijk.nl
 * @url: https://github.com/lekkerduidelijk/gulp-template
 *
 * @TODO:
 * - Add media task
 * - Add UnCSS task
 * - Add banner task
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

// var autoprefixer = new plugins.lessPluginAutoprefix({ browsers: ["last 2 versions"]});

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

  // Notify
  .pipe(plugins.notify("LESS complete"));

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

  // Notify
  .pipe(plugins.notify("JS complete"));

});


/* Watch
   ========================================================================== */

gulp.task('watch', function () {
  gulp.watch('js/**/*.js', ['js']);
  gulp.watch('less/**/*.less', ['less']);
  plugins.livereload.listen();
  // gulp.watch('/**/*').on('change', plugins.livereload.changed);
});

/* ==========================================================================
   Main tasks
   ========================================================================== */

/* Default
   ========================================================================== */

gulp.task('default', function (done){
  runSequence('build', 'watch', done);
});

/* Build
   ========================================================================== */

gulp.task('build', function (done) {
    runSequence(
      ['less', 'js'],
      done);
});
