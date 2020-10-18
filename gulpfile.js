const gulp = require('gulp');
const sass = require('gulp-sass');
const sourcemaps = require('gulp-sourcemaps');
const cssnano = require('gulp-cssnano');
const concat = require('gulp-concat');
const babel = require('gulp-babel');
const route = "assets";

sass.compiler = require('node-sass');

require("@babel/core").transform("code", {
	plugins: ["minify-builtins"]
});

var config = {
	dev: {
		sass: {
			precision: 6
		},
		cssnano: {
			autoprefixer: {
				add: true,
				browsers: ['> 3%', 'last 2 versions', 'ie > 9', 'ios > 5', 'android > 3']
			},
			zindex: false,
            discardUnused: {fontFace: false},
            minifyFontValues: false,
            reduceIdents: false,
            reducePositions: false
		}
	}
};

gulp.task('sass-base', function() {
	return gulp.src(route + '/sass/*.scss')
		.pipe(sourcemaps.init())
    	.pipe(sass(config.dev.sass).on('error', sass.logError))
		.pipe(cssnano(config.dev.cssnano))
		.pipe(sourcemaps.write('.'))
    	.pipe(gulp.dest(route + '/css'));
});

gulp.task('sass-devs', function() {
	return gulp.src(route + '/sass/devs/**/*.scss')
		.pipe(sourcemaps.init())
    	.pipe(sass(config.dev.sass).on('error', sass.logError))
		.pipe(cssnano(config.dev.cssnano))
		.pipe(sourcemaps.write('.'))
    	.pipe(gulp.dest(route + '/css'));
});


gulp.task('babel', () => {
	return gulp.src(route + '/js/*.js')
		.pipe(sourcemaps.init())
		.pipe(babel({
			presets: ["minify"]
		}))
		.pipe(concat('custom.min.js'))
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest(route + '/js/min'))
});

gulp.task('babel-admin', () => {
	return gulp.src(route + '/js/admin/*.js')
		.pipe(sourcemaps.init())
		.pipe(babel({
			presets: ["minify"]
		}))
		.pipe(concat('custom-admin.min.js'))
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest(route + '/js/min'))
});


gulp.task('watch', function () {
	gulp.watch(route + '/sass/*.scss', gulp.series('sass-base'));
	gulp.watch(route + '/sass/templates/*.scss', gulp.series('sass-base'));
	gulp.watch(route + '/sass/base/*.scss', gulp.series('sass-base'));
	gulp.watch(route + '/sass/menus/**/*.scss', gulp.series('sass-base'));
	gulp.watch(route + '/sass/devs/**/*.scss', gulp.series('sass-devs'));
	gulp.watch(route + '/js/*.js', gulp.series('babel'));
	gulp.watch(route + '/js/admin/*.js', gulp.series('babel-admin'));
});


gulp.task('default',gulp.series('sass-base','sass-devs','babel','babel-admin','watch'));
