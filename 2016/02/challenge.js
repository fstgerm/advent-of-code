const {input} = require('./input');

class Keypad {
    constructor(values, width) {
      this.code = 5;
      this.keys = values.split('');
      this.width = width;

      this.print();
    }

    current() {
      return this.keys.findIndex(x => x == this.code);
    }

    move(direction) {
      var current = this.current();
      var next = current;

      if (direction == 'U' && current - this.width > 0) {
        next -= this.width;
      } else if (direction == 'R' && (current + 1) % this.width) {
        next += 1;
      } else if (direction == 'D' && current + this.width < this.keys.length) {
        next += this.width;
      } else if (direction == 'L' && current % this.width) {
        next -= 1;
      }

      if (this.keys[next].match(/^[0-9a-zA-Z]+$/)) {
        this.code = this.keys[next];
      }
    }

    print() {
      var regex = new RegExp('(.{' + this.width * 2 + '})', 'g');
      console.log(this.keys.join(' ').replace(regex, "$1\n").replace(this.code, "\x1b[32m" + this.code + "\x1b[0m") + "\n");
    }
}

var instructions = input.split('\n');
var keypad_one = new Keypad('123456789', 3);
var keypad_two = new Keypad('  1   234 56789 ABC   D  ', 5);
var anwser_one = '';
var anwser_two = '';


instructions.forEach(directions => {
  directions.split('').forEach(direction => {
    keypad_one.move(direction);
    keypad_two.move(direction);
  });

  anwser_one += keypad_one.code;
  anwser_two += keypad_two.code;
});

console.log(1, anwser_one);
console.log(2, anwser_two);
