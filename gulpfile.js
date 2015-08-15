var gulp 	= require('gulp'),
	uglify	= require('gulp-uglify'),
	sass	= require('gulp-ruby-sass'),
	concat	= require('gulp-concat'),
	minify	= require('gulp-clean-css'),
	jshint	= require('gulp-jshint'),
	prefix	= require('gulp-autoprefixer');


//Display error messages 
function errorLog(error)
{
	console.error.bind(error);
	this.emit('end');
}


//libs Task
//Concat and uglify script libraries
gulp.task('jsLibs', function(){
	gulp.src([
		'node_modules/angular/angular.js',
		'node_modules/angular-ui-router/build/angular-ui-router.js',
		'node_modules/angular-bootstrap/ui-bootstrap-tpls.js',
		'node_modules/satellizer/satellizer.js'])
	.pipe(uglify())
	.pipe(concat('libs.js'))
	.pipe(gulp.dest('public/js/'));

});

//sass task
//Concat and uglify sass file
gulp.task('sass', function(){
	return sass('resources/assets/sass/app.scss', { style: 'compressed' })
	.on('error', errorLog)
	.pipe(prefix('last 2 versions'))
	.pipe(gulp.dest('public/css/'));
});


//js task
//Concat and uglify app javascript
gulp.task('js', function(){	
	gulp.src([
		'resources/assets/js/app.js',
		'resources/assets/js/controllers/authController.js',
		'resources/assets/js/controllers/userController.js'])	
	.pipe(uglify({mangle: false}))
	.pipe(concat('app.js'))
	.pipe(gulp.dest('public/js/'));

});


gulp.task('default', ['jsLibs','sass', 'js']);