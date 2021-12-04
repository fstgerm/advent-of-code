with open('input.txt') as f:
    depths = [int(line.rstrip()) for line in f]

total = sum([a < b for (a, b) in zip(depths, depths[1:])])

print(total)