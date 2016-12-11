gulp             = require('gulp');
sass             = require('gulp-sass');
less             = require('gulp-less');
watch			 = require('gulp-watch');
plumber		 	 = require('gulp-plumber');
autoprefixer     = require('gulp-autoprefixer');
stripCssComments = require('gulp-strip-css-comments');
uglify			 = require('gulp-uglify');
rename			 = require('gulp-rename');

watching         = false;
watchingMessage  = false;

watchingCallback = function() {
	if ( watching && !watchingMessage ) {
		console.log('Watching files...');
		watchingMessage = true;
	}
};

gulp.task('sass', function() {

	handler = gulp.src( 'sass/*.scss' )
		.pipe( plumber() )
        .pipe( sass.sync().on('error', sass.logError) )
		.pipe( autoprefixer({ browsers: ['> 1%', 'last 99 versions', 'iOS 6', 'not ie <= 8'] }) )
		.pipe( stripCssComments() )
		.pipe( gulp.dest('css/') )
		.on('finish', watchingCallback);

	watchingMessage = false;

});

gulp.task('less', function() {

	handler = gulp.src( 'less/*.less' )
		.pipe( plumber() )
        .pipe( sass.sync().on('error', sass.logError) )
		.pipe( autoprefixer({ browsers: ['> 1%', 'last 99 versions', 'iOS 6', 'not ie <= 8'] }) )
		.pipe( stripCssComments() )
		.pipe( gulp.dest('css/') )
		.on('finish', watchingCallback);

	watchingMessage = false;

});



gulp.task('js', function() {

	gulp.src('js/*.js')
		.pipe( plumber() )
		.pipe( uglify() )
		.pipe(rename({
			suffix: '.min'
		}))
		.pipe( gulp.dest('js/min/') )
		.on('finish', watchingCallback);

	watchingMessage = false;

});

gulp.task('default', ['sass', 'js', 'less'], function(event) {

	watching    = true;
	sassWatcher = gulp.watch( 'sass/*.scss', ['sass'] );

	lessWatcher = gulp.watch( 'less/*.less', ['less'] );

	sassWatcher.on('change', function() {
		console.log('Change detected, compiling sass...');
	});

	lessWatcher.on('change', function() {
		console.log('Change detected, compiling less...');
	});

	jsWatcher = gulp.watch( 'js/*.js', ['js'] );

	jsWatcher.on('change', function() {
		console.log('Change detected, minifying js...');
	});

});