const { mix } = require('laravel-mix');

mix.js('src/assets/js/main.js', './dist')
   .sass('src/assets/sass/style.scss', './dist/css');
