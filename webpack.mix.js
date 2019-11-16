const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .sass('node_modules/admin-lte/build/scss/AdminLTE.scss', 'public/css')
   .styles([
   		'node_modules/@fortawesome/fontawesome-free/css/all.css',
   		'node_modules/admin-lte/plugins/overlayScrollbars/css/OverlayScrollbars.css',
   		'public/css/AdminLTE.css',
   	], 'public/css/main.css')
   .js([
   		'node_modules/jquery/src/jquery.js',
   		'node_modules/admin-lte/plugins/bootstrap/js/bootstrap.bundle.js',
   		'node_modules/admin-lte/plugins/overlayScrollbars/js/OverlayScrollbars.js',
   		'node_modules/admin-lte/dist/js/adminlte.js',
   	], 'public/js/main.js')
   .copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts')
   .version();