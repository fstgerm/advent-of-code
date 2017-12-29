import Foundation

let file = Bundle.main.url(forResource: "input", withExtension: "txt")
let input = try String(contentsOf: file!, encoding: String.Encoding.utf8)
let commands = input.components(separatedBy: "\n").flatMap{Int(String($0))}

struct Maze {
  var cursor: Int = 0
  var steps = 0
  var commands: [Int]

  init(commands: [Int]) {
    self.commands = commands
  }

  mutating func escape() {
    while self.cursor < self.commands.count {
      let cursor = self.cursor

      self.cursor += self.commands[cursor]
      self.commands[cursor] += 1
      self.steps += 1
    }
  }
}

var maze = Maze(commands: commands)

maze.escape()

print(maze.steps)
