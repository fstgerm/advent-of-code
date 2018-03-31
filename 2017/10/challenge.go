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
    s.Position, s.Skip = (s.Position + size + s.Skip) % len(s.Numbers), s.Skip + 1
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

func (s *Sequence) Hash() (hash string) {
  for i := 0; i < len(s.Numbers); i += 16 {
    hash += fmt.Sprintf("%02x", Xor(s.Numbers[i:i+16]))
  }
	return
}

func Xor(numbers []int) (result int) {
	for _, v := range numbers {
		result ^= v
	}
  return
}

func main() {
  file, _ := ioutil.ReadFile("input.txt")
  input := strings.TrimSpace(string(file))
  lengths := strings.Split(input, ",")
  sequence1 := NewSequence(256)

  for _, v := range lengths {
    length, _ := strconv.Atoi(v)
    sequence1.Reverse(length)
    sequence1.Move(length)
  }

  fmt.Println("Part 1 :", sequence1.Multiple())

  secret := []byte{17, 31, 73, 47, 23}
  hex := []byte(input + string(secret[:]))
  sequence2 := NewSequence(256)

  for i := 0; i < 64; i++ {
    for _, v := range []byte(hex) {
      length := int(v)
      sequence2.Reverse(length)
      sequence2.Move(length)
    }
  }

  fmt.Println("Part 2 :", sequence2.Hash())
}
