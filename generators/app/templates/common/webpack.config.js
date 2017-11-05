const path = require('path');
const webpack = require('webpack');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
const OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin;

const isProduction = process.env.NODE_ENV === 'production';
const analyzeBundle = process.env.ANALYZE === 'true';

const plugins = [
    new ExtractTextPlugin('style.css'),
    new webpack.ProvidePlugin({
        <%_ if (jquery === true || slick_slider === true) { -%>
        $              : 'jquery',
        jQuery         : 'jquery',
        'window.jQuery': 'jquery',
        <%_ } -%>
        <%_ if (tweenmax === true || scrollmagic === true) { -%>
        TweenMax: 'gsap/TweenMax.js',
        <%_ } -%>
        <%_ if (is_js === true) { -%>
        is: 'is_js',
        <%_ } -%>
        <%_ if (scrollmagic === true) { -%>
        ScrollMagic: 'ScrollMagic/scrollmagic/uncompressed/ScrollMagic.js'
        <%_ } -%>
    }),
    new webpack.optimize.CommonsChunkPlugin({
        name     : 'vendor',
        filename : 'vendor.js',
        minChunks: Infinity
    }),
    new webpack.DefinePlugin({
        'process.env.NODE_ENV': '"production"'
    }),
    new BrowserSyncPlugin({
        host : 'localhost',
        port : 3000,
        proxy: 'http://www.<%= name %>.loc/',
        files: ['**/*.php', '**/*.html', './static/dist/*.js', './static/dist/*.css']
    }, {
        reload: false
    })
];

if (isProduction) {
    plugins.push(
        new UglifyJsPlugin({}),
        new OptimizeCssAssetsPlugin({
            cssProcessorOptions: {
                safe: true
            }
        })
    );
}

if (analyzeBundle) {
    plugins.push(
        new BundleAnalyzerPlugin({
            analyzerMode: 'server'
        })
    )
}

module.exports = {
    entry  : {
        main  : './static/js/index.js',
        vendor: './static/js/vendor.js'
    },
    output : {
        path      : path.join(__dirname, 'static/dist'),
        publicPath: 'static/dist/',
        filename  : 'bundle.js'
    },
    devtool: 'source-map',
    resolve: {
        alias  : {
            style: path.resolve(__dirname, 'static/scss')
        },
        modules: [path.resolve(__dirname, 'static/js'), 'node_modules']
    },
    module : {
        rules: [{
            test   : /\.js$/,
            include: [
                path.resolve(__dirname, 'static/js')
            ],
            exclude: [
                path.resolve(__dirname, 'static/js/vendor'),
                /node_modules/
            ],
            use    : 'babel-loader'
        }, {
            test: /\.scss$/,
            use : ExtractTextPlugin.extract({
                use: [
                    {
                        loader : 'css-loader',
                        options: {
                            sourceMap: true,
                            url      : false
                        }
                    },
                    {
                        loader : 'postcss-loader',
                        options: {
                            sourceMap: true
                        }
                    },
                    {
                        loader : 'sass-loader',
                        options: {
                            sourceMap: true
                        }
                    }
                ]
            })
        }]
    },
    plugins: plugins,
    externals: {
    <%_ if (tweenmax === true || scrollmagic === true) { -%>
        'TweenLite': 'TweenLite',
        'TimelineMax': 'TimelineMax',
        'TweenMax': 'TweenMax'
    <%_ } -%>
    }
};