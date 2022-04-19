<?php

/*
 * By adding type hints and enabling strict type checking, code can become
 * easier to read, self-documenting and reduce the number of potential bugs.
 * By default, type declarations are non-strict, which means they will attempt
 * to change the original type to match the type specified by the
 * type-declaration.
 *
 * In other words, if you pass a string to a function requiring a float,
 * it will attempt to convert the string value to a float.
 *
 * To enable strict mode, a single declare directive must be placed at the top
 * of the file.
 * This means that the strictness of typing is configured on a per-file basis.
 * This directive not only affects the type declarations of parameters, but also
 * a function's return type.
 *
 * For more info review the Concept on strict type checking in the PHP track
 * <link>.
 *
 * To disable strict typing, comment out the directive below.
 */

declare(strict_types=1);

class BeerSong
{
    private $songArr = ['No more bottles of beer on the wall, no more bottles of beer.' . "\n" .
        'Go to the store and buy some more, 99 bottles of beer on the wall.' . "\n", "1 bottle of beer on the wall, 1 bottle of beer.\n" .
        "Take it down and pass it around, no more bottles of beer on the wall.\n" .
        "\n", "2 bottles of beer on the wall, 2 bottles of beer.\n" .
        "Take one down and pass it around, 1 bottle of beer on the wall.\n" .
        "\n"];

    function __construct()
    {
        $song = '%1$d bottles of beer on the wall, %1$d bottles of beer.' . "\n" .
            'Take one down and pass it around, %2$s bottles of beer on the wall.' . "\n";

        for ($i = 3; $i <= 99; $i++) {
            $next = ($i == 1) ? "no" : (string)$i - 1;
            $this->songArr[$i] = sprintf($song, $i, $next);
        }

        $this->songArr = array_reverse($this->songArr, true);
    }

    public function verse(int $number): string
    {
        return $this->songArr[$number];
    }

    public function verses(int $start, int $finish): string
    {
        $res = "";
        for ($i = $start; $i >= $finish; $i--) {
            $res .= $this->songArr[$i];
        }

        return trim($res, "\n");
    }

    public function lyrics(): string
    {
        return implode($this->songArr);
    }
}

$song = new BeerSong();
#echo $song->verse(1);
#echo $song->lyrics();
echo $song->verses(2, 0);
#print_r($song->songArr);