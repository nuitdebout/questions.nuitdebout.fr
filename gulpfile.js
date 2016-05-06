var gulp = require('gulp'),
    less = require('gulp-less'),
    cssmin = require('gulp-cssmin'),
    rename = require('gulp-rename'),
    $ = require('gulp-load-plugins')();


gulp.task('styles', function () {
    gulp.src(['qa-theme/Donut-theme/less/donut.less',
              'qa-theme/Donut-theme/less/nuitdebout.less'])
        .pipe(less())
        .pipe($.autoprefixer('last 2 version'))
        .pipe($.concatCss("donut.css"))
        .pipe(gulp.dest('qa-theme/Donut-theme/css'))
        .pipe(cssmin())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('qa-theme/Donut-theme/css'));
});


gulp.task('watch', function() {
    gulp.watch('assets/scss/**.*scss', ['styles']);
});