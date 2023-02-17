// npm init -y
// npm i gulp sass node-sass gulp-sass gulp-sourcemaps gulp-clean-css --save-dev

const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const sourcemaps = require('gulp-sourcemaps');
const cleanCSS = require('gulp-clean-css');


const paths = {
  styles: {
    src: './ddl-v2/assets/scss/**/*.scss',
    dest: './ddl-v2'
  }
};


function css() {
  return gulp
  .src(paths.styles.src)
  .pipe(sourcemaps.init())
  // .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
  .pipe(sass({ outputStyle: 'expanded' }).on('error', sass.logError))
  .pipe(cleanCSS({format: 'beautify'}))
  .pipe(sourcemaps.write('.'))
  .pipe(gulp.dest(paths.styles.dest))
}

exports.css = css;


function watch() {
  gulp.watch(paths.styles.src, css);
}

exports.watch = watch;