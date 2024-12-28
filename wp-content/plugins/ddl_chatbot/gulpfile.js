// npm init -y
// npm install gulp sass node-sass gulp-sass gulp-sourcemaps gulp-concat gulp-uglify gulp-multi-dest gulp-inject-views --save-dev
// npm install gulp sass node-sass gulp-sass gulp-sourcemaps gulp-concat gulp-uglify --save-dev


const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const sourcemaps = require('gulp-sourcemaps');
const concat = require('gulp-concat');
// const uglify = require('gulp-uglify');
// const multiDest = require('gulp-multi-dest');
// const inject = require('gulp-inject-views');


const paths = {

  styles: {
    src: './assets/scss/**/*.scss',
    dest: './assets/css'
  },

  // scripts: {
  //   src: './assets/js/**/*.js',
  //   dest: './assets/js'
  // },

};

	
function css() {
  return gulp
  .src(paths.styles.src)
  .pipe(sourcemaps.init())
  .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
  .pipe(concat('chatbot-style.css'))
  .pipe(sourcemaps.write('.'))
  .pipe(gulp.dest(paths.styles.dest))
  // .pipe(multiDest(paths.styles.dest))
}

exports.css = css;


// function js() {
//   return gulp
//   .src(paths.scripts.src)
//   .pipe(concat('cookie-script.js'))
//   .pipe(inject('./src/html/*.html'))
//   .pipe(uglify())
//   // .pipe(gulp.dest(paths.scripts.dest))
//   .pipe(multiDest(paths.scripts.dest))
// }

// exports.js = js;


// function php() {
//   return gulp
//   .src(paths.php.src)
//   .pipe(multiDest(paths.php.dest))
// }

// exports.php = php;


function watch() {
  gulp.watch(paths.styles.src, css);
  // gulp.watch(paths.scripts.src, js);
  // gulp.watch(paths.php.src, php);
}

exports.watch = watch;