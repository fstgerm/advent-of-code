package main

import (
  "bufio"
  "fmt"
  "os"
  "regexp"
  "strconv"
)

var total int

func main() {
  file, _ := os.Open("input.txt")
  fscanner := bufio.NewScanner(file)

  for fscanner.Scan() {
    min, max := getNumbers(fscanner.Text())
    total += max - min
  }

  fmt.Println(total)
}

func getNumbers(text string) (min , max int) {
  pattern := regexp.MustCompile("[0-9]+")
  matches := pattern.FindAllString(text, -1)

  for _, value := range matches {
    number, _ := strconv.Atoi(value)

    if number < min || min == 0 {
      min = number
    }

    if number > max || max == 0 {
      max = number
    }
  }

  return
}
