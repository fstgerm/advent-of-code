package main

import (
  "bufio"
  "fmt"
  "os"
  "regexp"
  "strconv"
)

var total1, total2 int

func main() {
  file, _ := os.Open("input.txt")
  fscanner := bufio.NewScanner(file)

  for fscanner.Scan() {
    numbers := findNumbers(fscanner.Text())
    total1 += subtract(numbers)
    total2 += divide(numbers)
  }

  fmt.Printf("Part 1 : %d\n", total1)
  fmt.Printf("Part 2 : %d\n", total2)
}

func findNumbers(text string) (numbers []int) {
  pattern := regexp.MustCompile("[0-9]+")
  matches := pattern.FindAllString(text, -1)

  for _, value := range matches {
    n, _ := strconv.Atoi(value)
    numbers = append(numbers, n)
  }

  return
}

func subtract(numbers []int) int {
  min := numbers[0]
  max := numbers[0]

  for _, value := range numbers {
    if value < min {
      min = value
    }

    if value > max {
      max = value
    }
  }

  return max - min
}

func divide(numbers []int) int {
  for _, a := range numbers {
    for _, b := range numbers {
      if a % b == 0 && a != b {
        return a / b
      }
    }
  }

  return 0
}
