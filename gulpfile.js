// npm init -y
// npm install gulp sass node-sass gulp-sass gulp-sourcemaps gulp-concat gulp-uglify --save-dev
// npm i gulp sass node-sass gulp-sass gulp-sourcemaps gulp-clean-css --save-dev

const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const sourcemaps = require('gulp-sourcemaps');
const cleanCSS = require('gulp-clean-css');
// const concat = require('gulp-concat');
// const uglify = require('gulp-uglify');


const paths = {

  styles: {
    src: './wp-content/themes/ddl-theme/assets/scss/**/*.scss',
    dest: './wp-content/themes/ddl-theme'
  }

  // scripts: {
  //   src: [
  //     './ddl-v2/assets/js/navigation.js',
  //     './ddl-v2/assets/js/select2.js',
  //     './ddl-v2/assets/js/slick.js',
  //     './ddl-v2/assets/js/wow.js',
  //     './ddl-v2/assets/js/validate.js',
  //     './ddl-v2/assets/js/script.js'
  //   ],
  //   dest: './ddl-v2'
  // }

};


// function css() {
//   return gulp
//   .src(paths.styles.src)
//   .pipe(sourcemaps.init())
//   .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
//   .pipe(sourcemaps.write('.'))
//   .pipe(gulp.dest(paths.styles.dest))
// }

function css() {
  return gulp
  .src(paths.styles.src)
  .pipe(sourcemaps.init())
  .pipe(sass({ outputStyle: 'expanded' }).on('error', sass.logError))
  .pipe(cleanCSS({format: 'beautify'}))
  .pipe(sourcemaps.write('.'))
  .pipe(gulp.dest(paths.styles.dest))
}

exports.css = css;


// function js() {
//   return gulp
//   .src(paths.scripts.src)
//   .pipe(concat('script.js'))
//   .pipe(uglify())
//   .pipe(gulp.dest(paths.scripts.dest))
// }

// exports.js = js;


function watch() {
  gulp.watch(paths.styles.src, css);
  // gulp.watch(paths.scripts.src, js);
}

exports.watch = watch;