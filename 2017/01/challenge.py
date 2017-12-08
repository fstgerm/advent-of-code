f = open('input.txt')
data = f.read().strip()
total = 0
last = None

for character in map(int, data + data[0]):
    if last == character:
        total += character

    last = character

print total
