const fs = require('fs');
const input = fs.readFileSync('input.txt', 'utf8');
const blocks = input.split("\t").map(Number);

class Banks {
  constructor (blocks) {
    this.blocks = blocks;
    this.states = [this.state()];
    this.loop_size = 0;

    this.redistribute();
  }

  redistribute () {
    while (true) {
      let state = this.cycle();
      let index = this.states.indexOf(state);

      if (index > -1) {
        this.loop_size = this.states.length - index;
        break;
      }

      this.states.push(state);
    }
  }

  cycle () {
    let count = Math.max.apply(Math, this.blocks);
    let index = this.blocks.indexOf(count);

    this.blocks[index] = 0;

    for (; count > 0; count--) {
      index = index + 1 > this.blocks.length - 1 ? 0 : index + 1;
      this.blocks[index]++;
    }

    return this.state();
  }

  state () {
    return this.blocks.join(',');
  }
}

const banks = new Banks(blocks);

console.log('Part 1 :', banks.states.length);
console.log('Part 2 :', banks.loop_size);
