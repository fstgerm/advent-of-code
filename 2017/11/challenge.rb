fh = open 'input.txt'
directions = fh.read.strip.split(',')
fh.close

class Grid
  attr_reader :furthest

  def initialize()
    @x = @y = @z = @furthest = 0
  end

  def move(direction)
    case direction
    when "n"
      @y += 1
      @z -= 1
    when "ne"
      @x += 1
      @z -= 1
    when "se"
      @x += 1
      @y -= 1
    when "s"
      @y -= 1
      @z += 1
    when "sw"
      @x -= 1
      @z += 1
    when "nw"
      @x -= 1
      @y += 1
    end

    if distance > @furthest
      @furthest = distance
    end
  end

  def distance()
    return (@x.abs + @y.abs + @z.abs) / 2
  end
end

grid = Grid.new()
directions.each { |d| grid.move(d) }

puts "Part 1 : #{grid.distance}"
puts "Part 2 : #{grid.furthest}"
