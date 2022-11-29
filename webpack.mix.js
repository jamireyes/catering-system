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
    .sourceMaps()
    .browserSync('catering-system.test');

mix.styles([
    'public/paper/css/bootstrap.min.css',
    'public/paper/css/paper-dashboard.css',
    'public/assets/css/custom.css'
    ], 'public/css/all.css');
