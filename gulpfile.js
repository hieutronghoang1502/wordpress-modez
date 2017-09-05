var gulp = require('gulp');
var browserSync = require('browser-sync');
var reload = browserSync.reload;
var minify = require('gulp-minify');
var minifyCss = require('gulp-minify-css');
var imagemin = require('gulp-imagemin');
var pngquant = require('imagemin-pngquant');
var sass = require('gulp-sass');

gulp.task('sass', function(){
	return  gulp.src('wp-content/themes/wpdancemodez/sass/*.scss')
				.pipe(sass())
				.pipe(gulp.dest('wp-content/themes/wpdancemodez/'))
				.pipe(browserSync.stream());
});

gulp.task('serve', ['sass'], function () {
	browserSync({
		notify: true,
		server: {
		baseDir: '.'
		}
	});

	gulp.watch(['*.php'], reload);
	// gulp.watch(['js/*.js'], reload);
	// gulp.watch(['css/*.css'], reload);
	gulp.watch("wp-content/themes/wpdancemodez/sass/*.scss", ['sass'], reload);
	gulp.watch("wp-content/themes/wpdancemodez/sass/*/*.scss", ['sass'], reload);
	gulp.watch("wp-content/themes/wpdancemodez/sass/*/*/*.scss", ['sass'], reload);
});

gulp.task('compress', function() {
	gulp.src('js/*.js')
		.pipe(minify({
		exclude: ['tasks'],
		ignoreFiles: ['-min.js']
	}))
	.pipe(gulp.dest('dist/js'));

	gulp.src('css/*.css')
		.pipe(minifyCss({compatibility: 'ie8'}))
		.pipe(gulp.dest('dist/css'));

	gulp.src('img/*')
		.pipe(imagemin({
			progressive: true,
			svgoPlugins: [{removeViewBox: false}],
			use: [pngquant()]
		}))
		.pipe(gulp.dest('dist/images'));
});

gulp.task('default', ['serve']);