<?php

#$bidimensional = array_fill(0, 4, array_fill(0, 4, 10));

#print_r($bidimensional);

$n = 30;
$x = 51;


if ($n > $x) {
    $absoluteDif = ($n - $x) * 3;
} else {
    $absoluteDif = ($x - $n);
}

echo $absoluteDif;