const postcss = require("postcss");
const sass = require("@csstools/postcss-sass");
const preset = require("postcss-preset-env");
const purgecss = require("@fullhuman/postcss-purgecss");
const cssnano = require("cssnano");

module.exports = {
	plugins: [
		postcss([sass()]).process("src/keto/scss/keto.scss", {
			syntax: require("postcss-scss"),
			parser: require("postcss-scss"),
		}),
		preset({
			stage: 1,
		}),
		purgecss({
			content: [
				"./**/*.{html,js,jsx,ts,tsx,php}",
				"./src/**/*.{html,js,jsx,ts,tsx,php}",
				"./components/**/*.{html,js,jsx,ts,tsx,php}",
			],
		}),
		cssnano({
			preset: [
				"default",
				{
					colormin: false,
				},
			],
		}),
	],
};
