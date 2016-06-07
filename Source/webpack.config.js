var webpack = require("webpack");

module.exports = 
{
	entry: "./web/assets/js/app.js",
	plugins:
	[
		new webpack.ProvidePlugin({
			$: "jquery",
			jQuery: "jquery"
		})
	],
	output: {
	    filename: 'bundle.js',
	    libraryTarget: 'var',
	    library: 'AmbuShift'
	  }
};