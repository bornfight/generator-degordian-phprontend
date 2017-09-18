const path = require('path');
const webpack = require('webpack');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const StyleLintPlugin = require('stylelint-webpack-plugin');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
const BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin;

const isProduction = (process.env.NODE_ENV === 'production');

// TODO: configure bundle analyzer as a npm script
//const bundleAnalyzer = isProduction === false ?
//    new BundleAnalyzerPlugin({
//        analyzerMode: 'static'
//    }) : false;

const plugins = [
    new ExtractTextPlugin('style.css'),
    new webpack.ProvidePlugin({
        $     : 'jquery',
        jQuery: 'jquery'
    }),
    new webpack.optimize.CommonsChunkPlugin({
        name     : 'vendor',
        filename : 'vendor.js',
        minChunks: Infinity
    }),
    new webpack.DefinePlugin({
        'process.env.NODE_ENV': '"production"'
    }),
    new StyleLintPlugin(),
    new BrowserSyncPlugin({
        // TODO: ADD 'Browse to www.domain-name.loc:3000/project-name during dev'
        host : 'localhost',
        port : 3000,
        // TODO: inject path in yeoman
        proxy: 'http://www.front.loc/webpack-start-kit/',
        files: ['**/*.php', '**/*.html', './static/dist/*.js', './static/dist/*.css']
    }, {
        reload: false
    })
];

if (isProduction) {
    plugins.push(new UglifyJsPlugin({}));
}

module.exports = {
    entry  : {
        main  : './static/js/index.js',
        vendor: [
            // Add modules here to include them to vendor.js file
            'jquery'
        ]
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
    plugins: plugins
};


// TODO: configure production build
// TODO: separate vendor folder
// DONE: add autoprefixer
// DONE: check postcss parser
// DONE: move zkeleton to sassbox
// DONE: config jquery - import from node_modules and set to global scope
