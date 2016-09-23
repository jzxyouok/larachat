const elixir = require('laravel-elixir');

// require('laravel-elixir-vue');

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

// elixir(function (mix) {
//     mix.scripts([
//         'vendor/vue.min.js',
//         'vendor/vue-resource.min.js',
//     ], 'public/js/vendor.js')
// });
elixir(function (mix) {
    mix.scripts([
        'bootstrap.js',
        'vendor/vue.min.js',
        'vendor/vue-resource.min.js',
    ], 'public/js/app.js')
});
elixir(function(mix) {
    mix.browserify('app.js');
});
// elixir(function(mix) {
//     mix.version(['css/app.css', 'js/app.js']);
// });