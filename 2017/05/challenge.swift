import Foundation

let file = Bundle.main.url(forResource: "input", withExtension: "txt")
let input = try String(contentsOf: file!, encoding: String.Encoding.utf8)
let commands = input.components(separatedBy: "\n").flatMap{Int(String($0))}

struct Maze {
  let commands: [Int]

  func escape(decrease: Bool = false) -> Int {
    var commands = self.commands
    var cursor = 0, steps = 0

    while cursor < commands.count {
      let command = commands[cursor]
      commands[cursor] += decrease && command > 2 ? -1 : 1
      cursor += command
      steps += 1
    }

    return steps
  }
}

var maze = Maze(commands: commands)

print("Part 1 : \(maze.escape())")
print("Part 2 : \(maze.escape(decrease: true))")
