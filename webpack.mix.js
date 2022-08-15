const mix = require('laravel-mix');

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/adduser.js", "public/js")
    .js("resources/js/checkInvalidDoc.js", "public/js")
    .js("resources/js/checkInvalidUser.js", "public/js")
    .js("resources/js/document.js", "public/js")
    .js("resources/js/manageuser.js", "public/js")
   .postCss("resources/css/app.css", "public/css", [
      require("tailwindcss"),
   ])
   .version();
