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
   .js('resources/js/map/create-map.js', 'public/js/map/create-map.js')
   .js('resources/js/map/edit-map.js', 'public/js/map/edit-map.js')
   .js('resources/js/search.js', 'public/js/search.js')
   .js('resources/js/home.js', 'public/js/home.js')
   .js('resources/js/stats/stats_chart.js', 'public/js/stats/stats_chart.js')
   .js('resources/js/braintree/pay.js', 'public/js/braintree/pay.js')
   .sass('resources/sass/app.scss', 'public/css');
//    .browserSync({
//        proxy: 'http://127.0.0.1:8000/'
//    });