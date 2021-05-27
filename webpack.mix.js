let mix = require('laravel-mix');
let StyleLintPlugin = require('stylelint-webpack-plugin');

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

mix.webpackConfig({
    resolve: {
        extensions: ['js', 'vue'],
        alias: {
            'vue$': 'vue/dist/vue.runtime.esm.js',
            '@': path.resolve('./resources/js')
        },
    },
    plugins: [
        new StyleLintPlugin({
            files: './resources/sass/**/*.scss',
            configFile: './.stylelintrc'
        }),
    ]
});

var outName = 'dev';

if (process.env.NODE_ENV == 'production') {
    outName = 'prod';
}

mix.js('resources/js/app.js', 'public/js/app.' + outName + '.js')
    .extract([
        'axios',
        'lodash',
        'moment',
        'sweetalert2',
        'vue',
        'vuex',
        'vue-router',
    ], 'public/js/vendor.' + outName + '.js');

mix.sass('resources/sass/app.scss', 'public/css/app.' + outName + '.css');


if (mix.inProduction()) {
    mix.version();
}
