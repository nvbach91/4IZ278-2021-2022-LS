const mix = require('laravel-mix');

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

// TinyMCE

mix.copyDirectory('vendor/tinymce/tinymce', 'public/js/tinymce');
mix.copy('resources/js/tinymce/langs/cs.js', 'public/js/tinymce/langs');

// favicon

mix.copyDirectory('resources/assets/favicon', 'public/favicon');

// Application

mix.js('resources/js/app.js', 'public/js').version();
mix.sass('resources/css/app.scss', 'public/css').version();

// Landing page

mix.js('resources/js/landing-page.js', 'public/js').version();
mix.sass('resources/css/landing-page.scss', 'public/css').version();

// Auth

mix.js('resources/js/auth.js', 'public/js').version();
mix.sass('resources/css/auth.scss', 'public/css').version();
