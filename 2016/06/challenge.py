import collections, os

def most_common(list):
    return max(set(list), key=list.count)

def least_common(list):
    return min(set(list), key=list.count)

def decrypt(filename):
    lines = [line.rstrip('\n') for line in open(filename)]
    characters = zip(*map(lambda x: list(x), lines))

    print ''.join(map(lambda x: most_common(x), characters))
    print ''.join(map(lambda x: least_common(x), characters))

decrypt(os.path.dirname(__file__) + '/input.txt')
