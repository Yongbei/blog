const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');


mix.styles([
	'resources/sass/libs/bootstrap.css',
	'resources/sass/libs/blog-post.css',
	'resources/sass/libs/font-awesome.css',
	'resources/sass/libs/metisMenu.css',
	'resources/sass/libs/sb-admin-2.css',
	'resources/sass/libs/styles.css',

], 'public/css/libs.css');

mix.scripts([
	'resources/js/libs/jquery.js',
	'resources/js/libs/bootstrap.js',
	'resources/js/libs/metisMenu.js',
	'resources/js/libs/sb-admin-2.js',
	'resources/js/libs/script.js',

], 'public/js/libs.js');
