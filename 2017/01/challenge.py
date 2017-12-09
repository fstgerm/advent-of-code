data = open('input.txt').read().strip()

def get_total(offset):
    total = 0
    for index, character in enumerate(data):
        if data[(index + offset) % len(data)] == character:
            total += int(character)
    return total

print "Part 1 : %d" % get_total(1)
print "Part 2 : %d" % get_total(len(data) / 2)
