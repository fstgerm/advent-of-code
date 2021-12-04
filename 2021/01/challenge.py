with open('input.txt') as f:
    depths = [int(line.rstrip()) for line in f]

def get_increase_total(numbers):
    return sum([a < b for (a, b) in zip(numbers, numbers[1:])])

def get_sum_by_window(numbers, size, step = 1):
    return [sum(numbers[i:i + size]) for i in range(0, len(numbers), step)]

part1 = get_increase_total(depths)
part2 = get_increase_total(get_sum_by_window(depths, 3))

print("PART 1 :", part1)
print("PART 2 :", part2)
