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
.vue() // <- Add this
;
mix.styles([
  'resources/css/reset.css',
  'resources/css/tooltips.css',
  'resources/css/number.css',
  'node_modules/tachyons/css/tachyons.css',

], 'public/css/fitzwilliam.css');
mix.sass('resources/css/global-styles.scss', 'public/css');
