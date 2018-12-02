from functools import reduce

numbers = map(int, open('input.txt').read().splitlines())
result = reduce((lambda a, b: a + b), numbers)

print("Part 1: %d" %(result))
