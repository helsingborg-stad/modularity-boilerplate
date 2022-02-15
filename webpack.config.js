const path = require('path');
const webpack = require('webpack');
const ManifestPlugin = require('webpack-manifest-plugin');
const WebpackNotifierPlugin = require('webpack-notifier');
const {CleanWebpackPlugin} = require('clean-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const FixStyleOnlyEntriesPlugin = require('webpack-fix-style-only-entries');
const OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const autoprefixer = require('autoprefixer');
const {getIfUtils, removeEmpty} = require('webpack-config-utils');
const {ifProduction, ifNotProduction} = getIfUtils(process.env.NODE_ENV);

module.exports = {
    mode: ifProduction('production', 'development'),

    /**
     * Add your entry files here
     */
    entry: {
        'css/modularity-recommend':               './source/sass/modularity-recommend.scss',
    },
    
    /**
     * Output settings
     */
    output: {
        filename: ifProduction('[name].min.js', '[name].min.js'),
        path: path.resolve(__dirname, 'dist'),
    },
    /**
     * Define external dependencies here
     */
    externals: {
    },
    module: {
        rules: [
            /**
             * Styles
             */
            {
                test: /\.(sa|sc|c)ss$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    {
                        loader: 'css-loader',
                        options: {
                            importLoaders: 3, // 0 => no loaders (default); 1 => postcss-loader; 2 => sass-loader
                            sourceMap: true,
                        },
                    },
                    {
                        loader: 'postcss-loader',
                        options: {
                            // plugins: [autoprefixer, require('postcss-object-fit-images')],
                            sourceMap: true,
                        },
                    },
                    {
                        loader: 'sass-loader',
                        options: {
                            sourceMap: true,
                        }
                    },
                    'import-glob-loader'
                ],
            },
        ],
    },
    plugins: removeEmpty([
        /**
         * Fix CSS entry chunks generating js file
         */
        new FixStyleOnlyEntriesPlugin(),

        /**
         * Clean dist folder
         */
        new CleanWebpackPlugin(),
        /**
         * Output CSS files
         */
        new MiniCssExtractPlugin({
            filename: ifProduction('[name].min.css', '[name].min.css')
        }),

        /**
         * Output manifest.json for cache busting
         */
        new ManifestPlugin({
            // Filter manifest items
            filter: function (file) {
                // Don't include source maps
                if (file.path.match(/\.(map)$/)) {
                    return false;
                }
                return true;
            },
            // Custom mapping of manifest item goes here
            map: function (file) {
                // Fix incorrect key for fonts
                if (
                    file.isAsset &&
                    file.isModuleAsset &&
                    file.path.match(/\.(woff|woff2|eot|ttf|otf)$/)
                ) {
                    const pathParts = file.path.split('.');
                    const nameParts = file.name.split('.');

                    // Compare extensions
                    if (pathParts[pathParts.length - 1] !== nameParts[nameParts.length - 1]) {
                        file.name = pathParts[0].concat('.', pathParts[pathParts.length - 1]);
                    }
                }
                
                return file;
            },
        }),

        /**
         * Required to enable sourcemap from node_modules assets
         */
        new webpack.SourceMapDevToolPlugin(),

        /**
         * Enable build OS notifications (when using watch command)
         */
        new WebpackNotifierPlugin({alwaysNotify: true, skipFirstNotification: true}),

        /**
         * Minimize CSS assets
         */
        ifProduction(new OptimizeCssAssetsPlugin({
            cssProcessorPluginOptions: {
                preset: ['default', {discardComments: {removeAll: true}}],
            },
        })),

    ]).filter(Boolean),
    devtool: ifProduction('none', 'eval-source-map'),
    stats: {children: false}
};