const mix = require('laravel-mix');

mix.copy('node_modules/select2/dist/css/select2.min.css', 'public/css')
   .copy('node_modules/select2/dist/js/select2.min.js', 'public/js');
