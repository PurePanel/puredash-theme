let mix = require('laravel-mix');

mix
    .sass('resources/scss/bootstrap/bootstrap.scss', 'resources/css')
    .sass('resources/scss/theme/theme.scss', 'resources/css')
    .sass('resources/scss/fonts/fonts.scss', 'resources/css')
    .sass('resources/scss/theme/rtl.scss', 'resources/css')
    .options({
       processCssUrls: false
   });