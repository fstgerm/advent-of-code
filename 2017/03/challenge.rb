INPUT = 265149

# Part 1
def get_distance(index)
  square = Math.sqrt(index).ceil
  length = square % 2 == 0 ? square + 1 : square
  distance = length / 2.floor

  (1..4).each do |i|
    min = length ** 2 - ((length - 1) * i)
    if index >= min
      distance += (index - (min + length / 2.ceil)).abs
      break
    end
  end

  return distance
end

puts "Part 1 : #{get_distance(INPUT)}"

# Part 2
Point = Struct.new(:x, :y, :value, :index) do
  def distance
    x.abs + y.abs
  end

  def move(x = 0, y = 0)
    self.x += x
    self.y += y
  end
end

class Grid
  attr_reader :squares

  def initialize(value)
    @squares = [[Point.new(0, 0, value, 1)]]
  end

  def add_square
    size = (squares[-1].length / 8).round * 8 + 8
    point = squares[-1][-1].clone
    squares.push(Array.new())
    length = size / 4

    (1..size).each do |i|
      case i
      when 2..length
        point.move(0, 1)
      when length + 1..length * 2
        point.move(-1, 0)
      when length * 2 + 1..length * 3
        point.move(0, -1)
      when length * 3 + 1..length * 4, 1
        point.move(1, 0)
      end

      point.index += 1
      point.value = find_value(point.x, point.y)
      squares[-1].push(point)
      point = point.clone
    end
  end

  def find_value(x, y)
    value = 0
    squares.last(2).flatten.each do |point|
      if (point.x - x).abs <= 1 && (point.y - y).abs <= 1
        value += point.value
      end
    end
    return value
  end
end

grid = Grid.new(1)
answer = nil

loop do
  grid.add_square
  grid.squares[-1].each do |point|
    if point.value > INPUT
      answer = point.value
      break
    end
  end
  break if answer
end

puts "Part 2 : #{answer}"
