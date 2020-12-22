<?php

$entries = file("input.txt", FILE_IGNORE_NEW_LINES);
$year = 2020;

foreach ($entries as $entry) {
  $difference = $year - $entry;

  if (in_array($difference, $entries)) {
    print $difference * $entry . PHP_EOL;
    break;
  }
}