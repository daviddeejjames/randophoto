//
// Gulpfile for Randophoto Project
//

'use strict';

const gulp = require('gulp');
const uglify = require('gulp-uglify');
const sass = require('gulp-sass');
const sourcemaps = require('gulp-sourcemaps');

gulp.task('message', function(){
  return console.log("The fact that Gulp is running, fills you with DETERMINATION!");
});

// Minify JS
gulp.task('minify', function(){
  gulp.src('src/js/*.js')
      .pipe(uglify())
      .pipe(gulp.dest('dist/js'));
});

// Compile Sass
gulp.task('sass', function(){
	gulp.src('src/sass/*.scss')
      .pipe(sourcemaps.init())
      .pipe(sass.sync({outputStyle: 'compressed'}).on('error', sass.logError))
      .pipe(sourcemaps.write())
      .pipe(gulp.dest('dist/css'));
});

gulp.task('sass:watch', function () {
  gulp.watch('src/sass/*.scss', ['sass']);
});

// Default task
gulp.task('default', ['message', 'minify', 'sass:watch']);