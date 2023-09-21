import fs from "fs";
import Values from "values.js";
import keto from "../../../keto.config.js";

const colors = keto.colors;
const variants = {};

// Convert RGB array to HEX string
function rgbToHex(rgbArray) {
	return "#" + rgbArray.map((value) => value.toString(16).padStart(2, "0")).join("");
}

// Loop through colors
for (const color in colors) {
	const value = colors[color];
	const variant = new Values(value);

	variants[`${color}`] = value;
	variants[`${color}-hover`] = rgbToHex(variant.tint(20).rgb);
	variants[`${color}-ultra-light`] = rgbToHex(variant.tint(85).rgb);
	variants[`${color}-light`] = rgbToHex(variant.tint(75).rgb);
	variants[`${color}-medium`] = rgbToHex(variant.tint(55).rgb);
	variants[`${color}-dark`] = rgbToHex(variant.shade(35).rgb);
	variants[`${color}-ultra-dark`] = rgbToHex(variant.shade(55).rgb);
}

// Add greys to the variants object
const white = "#fff";
const black = "#000";
const greyVariant = new Values(white);
variants["white"] = white;
variants["grey-1"] = rgbToHex(greyVariant.shade(10).rgb);
variants["grey-2"] = rgbToHex(greyVariant.shade(20).rgb);
variants["grey-3"] = rgbToHex(greyVariant.shade(30).rgb);
variants["grey-4"] = rgbToHex(greyVariant.shade(40).rgb);
variants["grey-5"] = rgbToHex(greyVariant.shade(50).rgb);
variants["grey-6"] = rgbToHex(greyVariant.shade(60).rgb);
variants["grey-7"] = rgbToHex(greyVariant.shade(70).rgb);
variants["grey-8"] = rgbToHex(greyVariant.shade(80).rgb);
variants["grey-9"] = rgbToHex(greyVariant.shade(90).rgb);
variants["black"] = black;

// Create the SCSS map string
const colorMap = `$colors: (\n${Object.entries(variants)
	.map(([color, value]) => `"${color}": ${value}`)
	.join(",\n")}\n);\n`;

// Read the existing content of workers.scss
fs.readFile("src/keto/scss/abstracts/_workers.scss", "utf8", (err, data) => {
	if (err) {
		console.error("Error reading workers.scss:", err);
		return;
	}

	// Find & replace the existing $colors map
	const colorRegex = /\$colors:\s*\([\s\S]*?\);/g;
	const oldColors = data.match(colorRegex);

	// Append the new $colors map to workers.scss
	const newColors = data.replace(oldColors, "").trim();
	const newColorMap = colorMap + "\n" + newColors + "\n";

	// Write the final content back to workers.scss
	fs.writeFile("src/keto/scss/abstracts/_workers.scss", newColorMap, (writeErr) => {
		if (writeErr) {
			console.error("Error adding colors to workers.scss:", writeErr);
		} else {
			console.log("Colors map have been updated in workers.scss!");
		}
	});
});
