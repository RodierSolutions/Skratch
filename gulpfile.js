'use strict';

const gulp = require('gulp');
var plumber = require('gulp-plumber');


///// Default - Run During Development
gulp.task('default', ['build-js', 'build-sass', 'browser-sync']);

  ///// Open Website Using Browser Sync /////
  var browserSync = require('browser-sync');
  var reload = browserSync.reload;
  var connect = require('gulp-connect-php');

  gulp.task('browser-sync', function () {
    connect.server({}, function (){
      browserSync({
        proxy: 'localhost', 
      });
    });
    gulp.watch('src/styles/scss/**/*.scss', ['build-sass']).on('change', browserSync.reload);
    gulp.watch('src/scripts/*.js', ['build-js']).on('change', browserSync.reload);
    gulp.watch('*.php').on('change', browserSync.reload);
    gulp.watch('src/gfx/*', ['build-images']).on('change', browserSync.reload);
  });


///// Build - Run for Newly Pulled Project /////
gulp.task('build', [ 'build-js', 'build-sass', 'build-images' ])

  ///// Compress JS Files --Move to Output /////
  var uglify = require('gulp-uglify');

  gulp.task('build-js', function() {
    gulp.src('src/scripts/*.js')
      .pipe(plumber()) // to keep errors from crashing gulp during watch task
      .pipe(uglify())
      .pipe(gulp.dest('assets/scripts/'));
  });


  ///// Compile Sass Files & Compress CSS --Move to Output /////
  var sass = require('gulp-sass');
  var prefix = require('gulp-autoprefixer');

  gulp.task('build-sass', function () {
    return gulp.src('src/styles/scss/main.scss')
      .pipe(plumber()) // to keep errors from crashing gulp during watch task
      .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
      .pipe(prefix('last 2 versions'))
      .pipe(gulp.dest('assets/styles/'))
  });


  ///// Compress all images /////
  var imagemin = require('gulp-imagemin');

  gulp.task('build-images', function () {
      return gulp.src('src/gfx/*')
      .pipe(imagemin())
      .pipe(gulp.dest('assets/gfx/'))
  });


/////  Copy Template Directory w/Output Files (ONLY) to deploy Folder for Deployment /////
gulp.task('prepare', [ 'moveRoot', 'moveAssets', 'moveComponents' ]);

  ///// Move all root files /////
  gulp.task('moveRoot', function () {
    return gulp.src(['*.php', 'style.css', 'favicon.ico' ])
      .pipe(gulp.dest('../deploy/'));
  });
  ///// Move template-parts folder /////
  gulp.task('moveComponents', function () {
    return gulp.src(['components/**'])
      .pipe(gulp.dest('../deploy/components'));
  });
  ///// Move assets folder /////
  gulp.task('moveAssets', function () {
    return gulp.src(['assets/**'])
      .pipe(gulp.dest('../deploy/assets'));
  });
  