const elixir = require('laravel-elixir')
require('laravel-mix')

elixir(function(mix) {
    mix.sass('app.scss');

    mix.scripts([
        '../../../node_modules/jquery/dist/jquery.js',
        '../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap.js',
        '../../../node_modules/highlightjs/highlight.pack.js',
        'app.js'
    ], 'public/js/app.js');

    mix.version([
        'css/app.css',
        'js/app.js'
    ]);

    //mix.copy('node_modules/font-awesome/fonts', 'public/build/fonts');

    mix.browserSync({proxy: 'localhost:8000'});
});