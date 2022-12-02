const fs = require("fs");
const input = fs.readFileSync("input.txt", "utf8");

const sum = (arr) => arr.reduce((a, b) => a + b, 0);

const totals = input
  .split("\n\n")
  .map((items) => sum(items.split("\n").map(Number)))
  .sort((a, b) => b - a);

console.log("Part 1 :", totals.at(0));
console.log("Part 2 :", sum(totals.slice(0, 3)));
