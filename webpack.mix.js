
const mix = require('laravel-mix');

mix.setPublicPath("./");

// webpack.mix.js
mix.js("resources/js/app.js", "public/js")
.postCss("resources/css/app.css", "public/css",  [
    require('@tailwindcss/postcss7-compat'),
   ]);

mix.sass('resources/sass/custom.scss', 'public/css');