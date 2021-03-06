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

elixir.config.registerWatcher("default", "resources/**");

elixir(function(mix) {
    mix
        .copy('node_modules/foundation-datepicker/css/foundation-datepicker.min.css', 'public/assets/css/foundation-datepicker.min.css')
        .copy('node_modules/foundation-datepicker/js/foundation-datepicker.min.js', 'public/assets/js/foundation-datepicker.min.js')
        .copy('bower_components/semantic/dist/semantic.js', 'public/assets/js/semantic.js')
        .copy('bower_components/semantic/dist/semantic.css', 'public/assets/css/semantic.css')
        .copy('bower_components/semantic/dist/themes/default', 'public/assets/css/themes/default')
        .copy('bower_components/semantic/dist/themes/default', 'public/build/assets/css/themes/default')
        .copy('bower_components/jquery/dist/jquery.js', 'public/assets/js/jquery.js')
        .copy('resources/assets/js', 'public/assets/js')
        .less([
            'app.less'
        ], 'public/assets/css')
        .version([
            'public/assets/css/app.css',
            'public/assets/css/semantic.css',
            'public/assets/js/semantic.js',
            'public/assets/js/jquery.js',
            'public/assets/js/*',
            'public/assets/css/foundation-datepicker.min.css',
            'public/assets/js/foundation-datepicker.min.js'
        ]);
});
