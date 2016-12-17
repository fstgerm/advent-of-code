import hashlib, sys

input = 'uqwqemis'
size = 8
codes = [[], [None] * size]
i = 0
count = 0

def insert(value, index, position = count):
    global count, codes

    try:
        position = int(position)
    except ValueError:
        pass
    else:
        if index == 0 and len(codes[index]) < size:
            codes[index].append(value)
            count += 1
        elif index == 1 and position < size and codes[index][position] is None:
            codes[index][position] = value
            count += 1

while count < size * 2:
    encryption = hashlib.md5(input + str(i)).hexdigest()

    sys.stdout.write('%d/%d\r' % (count, size * 2))
    sys.stdout.flush()

    if encryption[0:5] == '00000':
        insert(encryption[5:6], 0)
        insert(encryption[6:7], 1, encryption[5:6])

    i += 1

print ''.join(codes[0])
print ''.join(codes[1])
