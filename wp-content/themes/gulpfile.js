// npm install --save-dev gulp

// npm install node-sass gulp-sass gulp-concat gulp-uglify --save-dev

const gulp = require('gulp');
const sass = require('gulp-sass');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');


const paths = {
  styles: {
    src: './ddl/assets/scss/**/*.scss',
    dest: './ddl'
  },
  scripts: {
    src: [
      './ddl/assets/js/jquery.js',
      './ddl/assets/js/navigation.js',
      // './ddl/assets/js/validate.js',
      './ddl/assets/js/slick.js',
      './ddl/assets/js/script.js'
    ],
    dest: './ddl'
  }
};

	
function css() {
  return gulp
  .src(paths.styles.src)
  .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
  .pipe(gulp.dest(paths.styles.dest))
}

exports.css = css;


function js() {
  return gulp
  .src(paths.scripts.src)
  .pipe(concat('script.js'))
  .pipe(uglify())
  .pipe(gulp.dest(paths.scripts.dest))
}

exports.js = js;


function watch() {
  gulp.watch(paths.styles.src, css);
  gulp.watch(paths.scripts.src, js);
}
	
exports.watch = watch;