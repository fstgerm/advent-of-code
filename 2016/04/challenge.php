<?php

class Room {
  var $name;
  var $sector_id;
  var $checksum;

  public function __construct($input) {
    $regex = "/(.*)[-](\d{3})[\[](.{5})[\]]/";

    preg_match_all($regex, $input, $matches, PREG_SET_ORDER);

    $this->name = $matches[0][1];
    $this->sector_id = (int) $matches[0][2];
    $this->checksum = $matches[0][3];
  }

  public function is_real() {
    $characters = str_replace('-', '', $this->name);
    $occurences = count_chars($characters, 1);
    $keys = array_map('chr', array_keys($occurences));

    array_multisort(array_values($occurences), SORT_DESC, $keys, SORT_ASC, $occurences);

    $occurences = array_combine($keys, $occurences);
    $first = array_keys(array_slice($occurences, 0, 5, true));

    return join($first, '') == $this->checksum;
  }

  public function decrypt() {
    return join('', array_map([$this, 'convert'], str_split($this->name)));
  }

  public function convert($character) {
    if ($character == '-') {
      return ' ';
    } else {
      $position = ord($character);
      $new_position = $position + ($this->sector_id % 26);

      if ($new_position > 122) {
        $new_position = $new_position - 26;
      }

      return chr($new_position);
    }
  }
}

$lines = file(__DIR__ . '/input.txt', FILE_IGNORE_NEW_LINES);
$rooms = array_map(function($line) {
  return new Room($line);
}, $lines);

$total = array_reduce($rooms, function($total, $room) {
  return $room->is_real() ? $total + $room->sector_id : $total;
});

echo "Total : $total\n";

// Part II

$northpole_room = array_filter($rooms, function($room) {
  return $room->decrypt() == 'northpole object storage';
});

$northpole_room = array_values($northpole_room)[0];

echo "Northpole sector ID : $northpole_room->sector_id\n";
