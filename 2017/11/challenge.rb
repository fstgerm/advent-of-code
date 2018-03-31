fh = open 'input.txt'
directions = fh.read.strip.split(',')
fh.close

Position = Struct.new(:x, :y, :z) do
  def move(direction)
    case direction
    when "n"
      self.y += 1
      self.z -= 1
    when "ne"
      self.x += 1
      self.z -= 1
    when "se"
      self.x += 1
      self.y -= 1
    when "s"
      self.y -= 1
      self.z += 1
    when "sw"
      self.x -= 1
      self.z += 1
    when "nw"
      self.x -= 1
      self.y += 1
    end
  end
end

position = Position.new(0, 0, 0)

directions.each { |x| position.move(x) }

puts (position.x.abs + position.y.abs + position.z.abs) / 2
