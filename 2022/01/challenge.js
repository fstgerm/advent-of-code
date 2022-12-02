const fs = require("fs");
const input = fs.readFileSync("input.txt", "utf8");

const sum = (arr) => arr.reduce((a, b) => a + b, 0);

const inventories = input.split("\n\n");
const calories = inventories.map((items) => sum(items.split("\n").map(Number)));

console.log("Part 1 : ", calories.sort().at(-1));
