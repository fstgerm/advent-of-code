package main

import (
  "fmt"
  "io/ioutil"
  "strconv"
  "strings"
)

type Sequence struct {
  Numbers []int
  Position int
  Skip int
}

func NewSequence(size int) *Sequence {
    numbers := make([]int, size)

    for i := 0; i < size; i++ {
      numbers[i] = i
    }

    return &Sequence{ Numbers: numbers, Position: 0, Skip: 0 }
}

func (s *Sequence) Move(size int) {
    s.Position = (s.Position + size + s.Skip) % len(s.Numbers)
    s.Skip += 1
}

func (s *Sequence) Reverse(size int) {
	for i := 0; i < size / 2; i++ {
    a := (s.Position + i) % len(s.Numbers)
		b := (s.Position + size - i - 1) % len(s.Numbers)
		s.Numbers[a], s.Numbers[b] = s.Numbers[b], s.Numbers[a]
	}
}

func (s Sequence) Multiple() int {
	return s.Numbers[0] * s.Numbers[1]
}

func main() {
  file, _ := ioutil.ReadFile("input.txt")
  lengths := strings.Split(strings.TrimSpace(string(file)), ",")
  sequence := NewSequence(256)

  for _, v := range lengths {
    length, _ := strconv.Atoi(v)
    sequence.Reverse(length)
    sequence.Move(length)
  }

  fmt.Println(sequence.Multiple())
}
