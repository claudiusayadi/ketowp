import fs from "fs";
import keto from "../../../keto.config.js";

const container = keto.container;

// Create the SCSS map string
const containerMap = `$container: (\n${Object.entries(container)
	.map(([container, value]) => `${container}: ${value}`)
	.join(",\n")}\n);\n`;

// Read the existing content of workers.scss
fs.readFile("src/keto/scss/abstracts/_workers.scss", "utf8", (err, data) => {
	if (err) {
		console.error("Error reading workers.scss:", err);
		return;
	}

	// Find & replace the existing $container map
	const containerRegex = /\$container:\s*\([\s\S]*?\);/g;
	const oldContainer = data.match(containerRegex);

	// Append the new $container map to workers.scss
	const newContainer = data.replace(oldContainer, "").trim();
	const newContainerMap = newContainer + "\n" + containerMap + "\n";

	// Write the final content back to workers.scss
	fs.writeFile("src/keto/scss/abstracts/_workers.scss", newContainerMap, (writeErr) => {
		if (writeErr) {
			console.error("Error adding container to workers.scss:", writeErr);
		} else {
			console.log("Container map have been updated in workers.scss!");
		}
	});
});
