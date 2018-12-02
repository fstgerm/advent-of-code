from functools import reduce

numbers = map(int, open('input.txt').read().splitlines())
result = reduce((lambda a, b: a + b), numbers)

print("Part 1: %d" %(result))

i = last = 0
list = []

while last not in list:
    list.append(last)
    last += numbers[i % len(numbers)]
    i += 1
else:
    print("Part 2: %d" %(last))
