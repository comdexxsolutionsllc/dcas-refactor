const {mix} = require('laravel-mix');

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


mix.copy('app/DCASDomain/VueJS/components', 'resources/assets/js/components')
    .js(['resources/assets/js/app.js', 'app/DCASDomain/VueJS/site.js'], 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .version()
    .browserSync({proxy: 'dcas-refactor.dev'});
