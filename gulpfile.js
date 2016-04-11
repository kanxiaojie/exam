var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss')
        .styles([
            'libs/sweetalert.css',
            'libs/select2.min.css',
            'libs/bootstrap.css',
            'libs/style.css',
            'libs/blue.css',
            'libs/font-awesome.css',
            'libs/font-awesome-ie7.css',
            'libs/custom.css',
            'libs/buttons.css',
            'libs/jquery.dynatable.css'
        ],'./public/css/libs.css')
        .scripts([
            '/libs/jquery-2.2.2.js',
            '/libs/jquery.dynatable.js',
            '/libs/bootstrap.js',
            '/libs/sweetalert-dev.js',
            'libs/select2.min.js',
            '/libs/custom.js'
        ],'./public/js/libs.js');
});
