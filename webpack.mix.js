const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .sass('node_modules/admin-lte/build/scss/AdminLTE.scss', 'public/css')
   .styles([
   		'node_modules/@fortawesome/fontawesome-free/css/all.css',
   		'node_modules/admin-lte/plugins/overlayScrollbars/css/OverlayScrollbars.css',
   		'public/css/AdminLTE.css',
      'node_modules/parsleyjs/src/parsley.css',
      'resources/css/custom-parsley.css',
   	], 'public/css/main.css')
   .js([
   		'node_modules/jquery/src/jquery.js',
   		'node_modules/admin-lte/plugins/bootstrap/js/bootstrap.bundle.js',
   		'node_modules/admin-lte/plugins/overlayScrollbars/js/OverlayScrollbars.js',
   		'node_modules/admin-lte/dist/js/adminlte.js',
   	], 'public/js/main.js')
   .copy('node_modules/parsleyjs/dist/parsley.min.js', 'public/js/parsley.min.js')
   .postCss('resources/sass/tailwind.css', 'public/css')
    .options({
        postCss: [
            require('postcss-import'),
            require('tailwindcss'),
        ]
    })
   .version();
