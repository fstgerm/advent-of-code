input = 265149

def get_steps(number)
  square = Math.sqrt(number).ceil
  length = square % 2 == 0 ? square + 1 : square
  steps = length/2.floor

  (1..4).each do |i|
    min = length ** 2 - ((length - 1) * i)
    if number >= min
      steps += (number - (min + length/2.ceil)).abs
      break
    end
  end

  return steps
end

puts get_steps(input)
