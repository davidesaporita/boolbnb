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

mix.js('resources/js/app.js', 'public/js/app.js')
    .js('resources/js/map/map-show.js', 'public/js/map/map-show.js')
    .js('resources/js/map/create-edit-map.js', 'public/js/map/create-edit-map.js')
    .sass('resources/sass/app.scss', 'public/css');
