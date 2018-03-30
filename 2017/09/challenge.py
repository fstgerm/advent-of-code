data = open('input.txt').read()
characters = iter(data)
score = depth = garbage_count = 0
garbage = False

for character in characters:
    if garbage:
        if character == '!':
            characters.next()
            continue
        if character == '>':
            garbage = False
            continue
        garbage_count += 1
    else:
        if character == '<':
            garbage = True
            continue

        if character == '}':
            depth -= 1

        if character == '{':
            depth += 1
            score += depth

print "Part 1 : %d" % score
print "Part 2 : %d" % garbage_count
