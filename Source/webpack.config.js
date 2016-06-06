var webpack = require("webpack");

module.exports = 
{
	entry: "./web/assets/js/app.js",
	output:
	{
		filename: "bundle.js"
	},
	plugins:
	[
		new webpack.ProvidePlugin({
			$: "jquery",
			jQuery: "jquery"
		})
	]
};