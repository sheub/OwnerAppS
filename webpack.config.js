var path = require('path');
var Encore = require('@symfony/webpack-encore');
//var ManifestPlugin = require('webpack-manifest-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');

Encore
// the project directory where all compiled assets will be stored
    .setOutputPath('public/build/')

    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')

    // allow legacy applications to use $/jQuery as a global variable
    .autoProvidejQuery()

    // enable source maps during development
    .enableSourceMaps(!Encore.isProduction())

    .enableVueLoader()

    // empty the outputPath dir before each build
    .cleanupOutputBeforeBuild()

    // show OS notifications when builds finish/fail
    //.enableBuildNotifications()

    // create hashed filenames (e.g. app.abc123.css)
    // .enableVersioning()
    
    // will output as public/build/vendor.js , main.js , sw.js 
    .addEntry('vendor', './assets/js/vendor.js')
    .addEntry("sw", './assets/js/sw.js')
	
	// will create public/build/app.js and public/build/app.css
    .addEntry('app', './assets/js/app.js')
	
    // will output as public/build/style.css
    .addStyleEntry('style', './assets/scss/style.scss')

    // allow sass/scss files to be processed
    .enableSassLoader()

    
    // .enableSassLoader(function (sassOptions) {
    // }, {
    //     resolveUrlLoader: false
    // })
    // .autoProvidejQuery()

    // static img
    .addPlugin(new CopyWebpackPlugin([
        // copies to {output}/static
        { from: './assets/images', to: 'images' }
    ]))
;

// export the final configuration
module.exports = Encore.getWebpackConfig();

//disable amd loader
module.exports.module.rules.unshift({
    parser: {
        amd: false
    }
});