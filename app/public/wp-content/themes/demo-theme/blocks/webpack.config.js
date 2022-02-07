module.exports = {
	entry: './index.js',
	output: {
		path: __dirname,
		filename: './index.build.js',
	},
	module: {
		loaders: [
			{
				test: /.js$/,
				loader: 'babel-loader',
				exclude: /node_modules/,
			},
		],
	},
};