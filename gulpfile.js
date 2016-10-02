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
        .copy('bower_components/semantic/dist/semantic.js', 'public/assets/js/semantic.js')
        .copy('bower_components/semantic/dist/semantic.css', 'public/assets/css/semantic.css')
        .copy('bower_components/semantic/dist/themes/default', 'public/assets/css/themes/default')
        .copy('bower_components/semantic/dist/themes/default', 'public/build/assets/css/themes/default')
        .copy('bower_components/jquery/dist/jquery.js', 'public/assets/js/jquery.js')
        .copy('resources/assets/js/script.js', 'public/assets/js/script.js')
        .copy('resources/assets/js/ajax-modal.js', 'public/assets/js/ajax-modal.js')
        .less([
            'app.less'
        ], 'public/assets/css')
        .version([
            'public/assets/css/app.css',
            'public/assets/css/semantic.css',
            'public/assets/js/semantic.js',
            'public/assets/js/jquery.js',
            'public/assets/js/script.js',
            'public/assets/js/ajax-modal.js'
        ]);
});
