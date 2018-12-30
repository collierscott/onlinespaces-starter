var Encore = require('@symfony/webpack-encore');

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')
    .enableVersioning()

    /*
     * ENTRY CONFIG
     *
     * Add 1 entry for each "page" of your app
     * (including one that's included on every page - e.g. "app")
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
     */

    .addEntry('app', './assets/js/app.js')
    //.createSharedEntry('app', './assets/js/app.js')
    //.addEntry('page1', './assets/js/page1.js')
    //.addEntry('page2', './assets/js/page2.js')
    .splitEntryChunks()

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()
    // .enableReactPreset()
    //.addEntry('admin', './assets/js/admin.js')

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    .configureBabel(function(babelConfig) {
    //     // add additional presets
    //     // babelConfig.presets.push('@babel/preset-flow');
    //
    //     // no plugins are added by default, but you can add some
    //     // babelConfig.plugins.push('styled-jsx/babel');
    // }, {
    //     // node_modules is not processed through Babel by default
    //     // but you can whitelist specific modules to process
    //     // include_node_modules: ['foundation-sites']
    //
    //     // or completely control the exclude
    //     // exclude: /bower_components/
    })

    // enables Sass/SCSS support
    .enableSassLoader()

    .enablePostCssLoader((options) => {
        options.config = {
            path: 'postcss.config.js'
        };
    })

    // uncomment if you use TypeScript
    //.enableTypeScriptLoader()

    // uncomment if you're having problems with a jQuery plugin
    .autoProvidejQuery()

        // Images
    .copyFiles({
        from: './assets/images',
        // optional target path, relative to the output dir
        to: 'images/[path][name].[ext]',
        // only copy files matching this pattern
        pattern: /\.(png|jpg|jpeg|svg)$/
    })

    // favicon
    .copyFiles({
        from: './assets/images',
        // optional target path, relative to the output dir
        to: '../[path][name].[ext]',
        // only copy files matching this pattern
        pattern: /\.(ico)$/
    });

//module.exports = Encore.getWebpackConfig();

let config = Encore.getWebpackConfig();
config.watchOptions = { poll: true, ignored: /node_modules/ };

module.exports = [config];
