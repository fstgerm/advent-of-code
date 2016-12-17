<?php

class Screen {
  var $width = 0;
  var $height = 0;
  var $pixels = [];

  public function __construct($width, $height) {
    $this->width = $width;
    $this->height = $height;
    $this->pixels = array_fill(0, $this->width * $this->height, 0);
  }

  public function draw($width, $height) {
    for ($y = 0; $y < $height; $y++) {
      for ($x = 0; $x < $width; $x++) {
        $this->change($this->get_index($x, $y), 1);
      }
    }
  }

  public function move($axis, $index, $by) {
    switch ($axis) {
      case 'row':
        $by = $by % $this->width;
        $pixels = $this->get_row($index);
        break;

      case 'column':
        $by = $by % $this->height;
        $pixels = $this->get_column($index);
        break;

      default:
        echo 'Invalid axis';
    }

    $values = array_values($pixels);
    $keys = array_keys($pixels);
    $overflow = array_splice($values, -$by, $by);
    $pixels = array_combine($keys, array_merge($overflow, $values));

    foreach ($pixels as $key => $value) {
      $this->change($key, $value);
    }
  }

  public function change($index, $value) {
    $this->pixels[$index] = (int) !!$value;
  }

  public function get_row($index) {
    return array_slice($this->pixels, $index * $this->width, $this->width, true);
  }

  public function get_column($index) {
    $keys = range($index, $this->height * $this->width, $this->width);
    return array_intersect_key($this->pixels, array_flip($keys));
  }

  public function get_index($x, $y) {
    return $y * $this->width + $x;
  }

  public function print_screen() {
    $output = join('', $this->pixels);
    $output = chunk_split($output, $this->width, "\n");

    echo strtr($output, [0 => '·', 1 => '#']);
  }
}

$screen = new Screen(50, 6);
$lines = file(__DIR__ . '/input.txt', FILE_IGNORE_NEW_LINES);

foreach ($lines as $value) {
  preg_match('/rotate (?<axis>row|column) (x|y)=(?<index>\d+) by (?<by>\d+)/', $value, $rotate);
  preg_match('/rect (?<width>\d+)x(?<height>\d+)/', $value, $rect);

  if ($rotate) {
    $screen->move($rotate['axis'], $rotate['index'], $rotate['by']);
  } else if ($rect) {
    $screen->draw($rect['width'], $rect['height']);
  } else {
    echo 'Invalid line';
  }
}

$screen->print_screen();

echo "Total : " . array_count_values($screen->pixels)[1] . "\n";
