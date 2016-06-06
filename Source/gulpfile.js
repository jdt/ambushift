var gulp = require('gulp');
var gulpCopy = require('gulp-copy');
var webpack = require('webpack-stream');
var concat = require('gulp-concat');
var csso = require('gulp-csso');
var merge = require('merge-stream');

gulp.task('default', function() {
	
});

gulp.task('bundleCss', function() {
	var doBundle = gulp.src(['node_modules/bootstrap/dist/css/bootstrap.css', 'node_modules/jquery-ui/themes/base/jquery-ui.css', './web/assets/css/style.css'])
		.pipe(concat('bundle.css'))
		.pipe(gulp.dest('./web/assets/build'));

	var doCsso = gulp.src('./web/assets/build/bundle.css')
		.pipe(csso())
		.pipe(gulp.dest('./web/assets/dist'));

	return merge(doBundle, doCsso);
});

gulp.task('bundleJs', function() {
	return gulp.src('./web/assets/js/app.js')
	  .pipe(webpack(require('./webpack.config.js') ))
	  .pipe(gulp.dest('./web/assets/dist'));
});

gulp.watch('web/assets/js/*.js', ['bundleJs']);
gulp.watch('web/assets/css/*.css', ['bundleCss']);