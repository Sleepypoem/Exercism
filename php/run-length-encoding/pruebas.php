<?php

/*$string = "a-a-r-e-f-a";

#$string = str_replace("a", "tortuga", $string);

$strArray = explode("-", $string);

rsort($strArray);


$newArray = [];

foreach ($strArray as $key) {
    if ($key != "a") {
        array_push($newArray, $key);
    }
}
print_r($newArray);

echo "El tamaño del array es: " . count($newArray);

*/

$letras = range("a", "z");

$letrasParte = array_slice($letras, 26, 7);

print_r($letrasParte);

for ($i = 0; $i < count($txtArray); $i++) {
    $res .= mb_str_split($txtArray[$i])[0];
}
