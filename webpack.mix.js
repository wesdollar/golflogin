const mix = require("laravel-mix");

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

mix
  .react("resources/js/app.js", "public/js")
  .sass("resources/sass/app.scss", "public/css");

if (!mix.inProduction()) {
  mix.sourceMaps();
  mix.browserSync("golflogin.wes:8080");
}

if (mix.inProduction()) {
  mix.version();
}

mix.options({
  hmrOptions: {
    port: 8181,
    host: "localhost"
  }
});
