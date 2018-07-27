var gulp = require('gulp'),
    sass = require('gulp-ruby-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    cssnano = require('gulp-cssnano'),
    uglify = require('gulp-uglify'),
    imagemin = require('gulp-imagemin'),
    rename = require('gulp-rename'),
    order = require('gulp-order'),
    concat = require('gulp-concat'),
    notify = require('gulp-notify'),
    cache = require('gulp-cache'),
    livereload = require('gulp-livereload'),
    del = require('del'),
    shell = require('shell'),
    // spawn = require('child_process').spawn,
    gutil = require('gulp-util'),
    fs = require('file-system'),
    wp_path = process.env["HOME"] + "YOUR WP PATH HERE",
    wp_url = "YOUR WP HOST HERE";
    // security_reports_dir = "security_reports/";

gulp.task('styles', function() {
  return sass('src/assets/sass/style.scss', { style: 'expanded' })
    .pipe(autoprefixer('> 5%'))
    .pipe(gulp.dest('dist/css'))
    .pipe(rename({suffix: '.min'}))
    .pipe(cssnano())
    .pipe(gulp.dest('dist/css'))
    .pipe(notify({ message: 'Styles task complete' }));
});

// gulp.task('scripts', function() {
//   return gulp.src(['assets/js/*.js', 'assets/js/**/*.js'])
//     .pipe(order([
//         'assets/js/jquery-3.1.0.min.js',
//         'assets/js/jquery-easing.1.3.js',
//         'assets/js/modernizr.js',
//         'assets/js/slick.js',
//         'assets/js/main.js'
//     ], { base: './' }))
//     .pipe(concat('main.js'))
//     .pipe(gulp.dest('dist/js'))
//     .pipe(rename({suffix: '.min'}))
//     .pipe(uglify())
//     .pipe(gulp.dest('dist/js'))
//     .pipe(notify({ message: 'Scripts task complete' }));
// });

gulp.task('images', function() {
  return gulp.src('assets/images/*')
    .pipe(imagemin({ optimizationLevel: 5, progressive: true, interlaced: true }))
    .pipe(gulp.dest('dist/img'))
    .pipe(notify({ message: 'Images task complete' }));
});

gulp.task('clean', function() {
    return del(['dist/css', 'dist/js', 'dist/img']);
});

gulp.task('watch', function() {
  gulp.watch('src/assets/sass/**/*', ['styles']);
  // gulp.watch(['assets/js/*', 'assets/js/**/*'], ['scripts']);
  gulp.watch('assets/images/*', ['images']);

  livereload.listen();
  gulp.watch(['dist/**']).on('change', livereload.changed);
});


gulp.task('default', ['clean'], function() {
    gulp.start('styles', 'images');
});

function reportLog(childProc, logFile){
    var logStream = fs.createWriteStream(logFile, {flags: 'a'})

    childProc.stdout.setEncoding('utf8');
    childProc.stdout.on('data', function (data) {
        gutil.log(data);
        logStream.write(data);
    });

    childProc.stderr.setEncoding('utf8');
    childProc.stderr.on('data', function (data) {
        gutil.log(gutil.colors.red(data));
        gutil.beep();
    });
}
