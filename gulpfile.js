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
        .scripts([
            '../../../node_modules/angular/angular.min.js',
            '../../../node_modules/angular-route/angular-route.min.js',
            'services.js',
            'controllers.js',
            'app.js'
        ], 'public/js/app.js')
        .copy('node_modules/bootstrap-sass/assets/fonts', 'public/fonts')
        .version([
            'css/app.css',
            'js/app.js'
        ]);
});
