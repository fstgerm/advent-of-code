<?php

$input = file_get_contents(__DIR__ . '/input.txt');
$length = strlen(trim($input));
$cursor = 0;
$size = 0;

while ($cursor < $length) {
  $first = strpos($input, '(', $cursor);
  $last = strpos($input, ')', $cursor);

  if ($first && $last) {
    $marker = substr($input, $first, $last - $first + 1);

    preg_match('/\(([0-9]+)x([0-9]+)\)/', $marker, $matches);

    $total += $first - $cursor + $matches[1] * $matches[2];
    $cursor = $first + $matches[1] + strlen($marker);
  } else {
    $total += $length - $cursor;
    $cursor = $length;
  }
}

echo $total;
