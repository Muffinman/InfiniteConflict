let mix = require('laravel-mix')
let StyleLintPlugin = require('stylelint-webpack-plugin')
let path = require('path')

console.log(path.resolve('./resources/js'));

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

mix.alias({
    '@': path.join(__dirname, 'resources/js'),
    vue$: path.join(__dirname, 'node_modules/vue/dist/vue.runtime.esm.js'),
});

mix.vue();

mix.webpackConfig({
    resolve: {
        extensions: ['js', 'vue'],
    },
    plugins: [
        new StyleLintPlugin({
            files: './resources/sass/**/*.scss',
            configFile: './.stylelintrc'
        }),
    ]
})

var outName = 'dev'

if (process.env.NODE_ENV == 'production') {
    outName = 'prod'
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
    ], 'public/js/vendor.' + outName + '.js')

mix.sass('resources/sass/app.scss', 'public/css/app.' + outName + '.css')


if (mix.inProduction()) {
    mix.version()
}
