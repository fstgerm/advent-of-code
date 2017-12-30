const fs = require('fs');
const input = fs.readFileSync('input.txt', 'utf8');
const blocks = input.split("\t").map(Number);

class Bank {
  constructor (blocks) {
    this.blocks = blocks;
    this.states = [this.state()];
    this.redistribute();
  }

  redistribute () {
    while (true) {
      let state = this.cycle();

      if (this.states.indexOf(state) > -1) {
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

const bank = new Bank(blocks);

console.log('Part 1 :', bank.states.length);
