const mix = require('laravel-mix');

mix
    // compile javascript assets for plugin
    .js('assets/src/js/app.js', 'assets/js').vue({ version: 3 })

    /*
    // Polyfill for all targeted browsers
    .polyfill({
        enabled: mix.inProduction(),
        useBuiltIns: 'usage',
        targets: '> 0.5%, last 2 versions, not dead, Firefox ESR, not ie > 0',
    });
    */
