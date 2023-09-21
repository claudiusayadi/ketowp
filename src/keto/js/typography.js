import fs from "fs";
import keto from "../../../keto.config.js";

const fontFamily = keto.fontFamily;

// Create the SCSS map strings
const fontFamilyMap = `$fontFamily: (\n${Object.entries(fontFamily)
	.map(([fontFamily, value]) => `${fontFamily}: ${value}`)
	.join(",\n")}\n);\n`;

// Read the existing content of workers.scss
fs.readFile("src/keto/scss/abstracts/_workers.scss", "utf8", (err, data) => {
	if (err) {
		console.error("Error reading workers.scss:", err);
		return;
	}

	// Find & replace the existing $fontFamily map
	const fontFamilyRegex = /\$fontFamily:\s*\([\s\S]*?\);/g;
	const oldFontFamily = data.match(fontFamilyRegex);

	// Append the new $fontFamily map to workers.scss
	const newFontFamily = data.replace(oldFontFamily, "").trim();
	const newFontFamilyMap = newFontFamily + "\n" + fontFamilyMap;

	// Write the final content back to workers.scss
	fs.writeFile("src/keto/scss/abstracts/_workers.scss", newFontFamilyMap, (writeErr) => {
		if (writeErr) {
			console.error("Error adding Font Family to workers.scss:", writeErr);
		} else {
			console.log("Font Family maps have been updated in workers.scss!");
		}
	});
});
