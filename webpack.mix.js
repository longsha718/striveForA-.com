const mix = require('laravel-mix');


mix.webpackConfig({
    resolve: {
        alias: {
            // 'vue': 'vue/dist/vue.esm-browser',  // 开发版本
            'vue': 'vue/dist/vue.esm-browser.prod',  // 生产版本
        }
    }
});
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js').
js('resources/js/index.js', 'public/js').
    js('resources/js/personal.js', 'public/js').
    postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss'),
        require('autoprefixer'),
    ]);
