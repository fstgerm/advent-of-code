const {input} = require('./input');

var orientation = 0; // 0: North; 1: East; 2: South; 3: West
var history = [];
var x = 0;
var y = 0;

input.split(', ').forEach(sequence => {
  var direction = sequence[0];
  var distance = +sequence.substring(1);

  direction == 'L' ? orientation-- : orientation++;

  if (orientation > 3) {
    orientation = 0;
  } else if (orientation < 0) {
    orientation = 3;
  }

  for (let i = 0; i < distance; i++) {
    switch (orientation) {
      case 0:
        y++;
        break;
      case 1:
        x++;
        break;
      case 2:
        y--;
        break;
      case 3:
        x--;
        break;
      default:
        console.log('Invalid');
    }

    history.push(x + ',' + y);
  }
});

function getDistance(x, y) {
  return Math.abs(x) + Math.abs(y);
}

console.log(getDistance(x, y));

// Part II
var visited = [];

history.some(coordinate => {
  if (visited.includes(coordinate)) {
    var [x, y] = coordinate.split(',');
    console.log(getDistance(x, y));
    return true;
  }

  visited.push(coordinate);
});
