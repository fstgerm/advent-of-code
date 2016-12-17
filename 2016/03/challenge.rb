data = File.readlines(__dir__ + '/input.txt').map { |line| line.split.map(&:to_i) }

class Triangle
  def initialize(a, b, c)
    @sides = [a, b, c]
  end

  def valid
    @sides.all? {|side| (perimeter - side) > side }
  end

  def perimeter
    return @sides.reduce(:+)
  end
end

# Part I
triangles = []

data.each do |sides|
  a, b, c = sides
  triangles.push(Triangle.new(a, b, c))
end

puts "Part I  : " + triangles.select{|triangle| triangle.valid == true }.size.to_s

# Part II
triangles = []

data.each_slice(3) do |rows|
  rows[0].zip(rows[1], rows[2]).each do |sides|
    a, b, c = sides
    triangles.push(Triangle.new(a, b, c))
  end
end

puts "Part II : " + triangles.select{|triangle| triangle.valid == true }.size.to_s
