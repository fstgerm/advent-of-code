<?php

$lines = file(__DIR__ . '/input.txt', FILE_IGNORE_NEW_LINES);

function get_palindromes($string, $length = 4) {
  $half = ceil($length / 2);
  $palindromes = [];

  if ($string) {
    for ($i = 0; $i <= strlen($string) - $length; $i++) {
      $segment = substr($string, $i, $length);

      list($a, $b) = [substr($segment, 0, $half), substr($segment, -$half)];

      if ($a != $b && $a == strrev($b)) {
        $palindromes[] = $segment;
      }
    }
  }

  return $palindromes;
}

$total_1 = 0;
$total_2 = 0;

foreach ($lines as $line) {
  preg_match_all('/(?P<outside>[a-z]+)|(?:\[(?P<inside>[a-z]+)\])/', $line, $matches);

  // Part I
  $outside = $inside = [];

  array_walk($matches['outside'], function($m) use (&$outside) { $outside = array_merge($outside, get_palindromes($m, 4)); });
  array_walk($matches['inside'], function($m) use (&$inside) { $inside = array_merge($inside, get_palindromes($m, 4)); });

  if (count($outside) > 0 && count($inside) < 1) {
    $total_1++;
  }

  // Part II
  $outside = $inside = [];

  array_walk($matches['outside'], function($m) use (&$outside) { $outside = array_merge($outside, get_palindromes($m, 3)); });
  array_walk($matches['inside'], function($m) use (&$inside) { $inside = array_merge($inside, get_palindromes($m, 3)); });

  $outside = array_map(function($v) { return substr($v, 1) . substr($v, 1, 1); }, $outside);

  if (count(array_intersect($inside, $outside)) > 0) {
    $total_2++;
  }
}

echo "$total_1 ABBA\n$total_2 ABA\n";
