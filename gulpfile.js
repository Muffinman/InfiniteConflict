const elixir = require('laravel-elixir');

var bourbon = require('bourbon').includePaths;
var neat = require('bourbon-neat').includePaths;
var sassOptions = {
    includePaths: bourbon.concat(neat)
};

require('laravel-elixir-vue-2')

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


elixir(mix => {
    mix
    .sass('./resources/assets/sass/app.scss', 'public/css', null, sassOptions)
    .webpack('./resources/assets/js/app.js', 'public/js')
});