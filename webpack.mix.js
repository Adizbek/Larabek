const mix = require('laravel-mix');

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

mix.options({
    terser: {
        terserOptions: {
            compress: {
                drop_console: true,
            },
        },
    },
})

    .setPublicPath('public')
    .js('./resources/js/app.js', 'public/larabek')
    .sass('./resources/scss/app.scss', 'public/larabek')
    .babelConfig({
        plugins: ['@babel/plugin-proposal-class-properties'],
    })
    .version();
