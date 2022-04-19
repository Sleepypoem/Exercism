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

class HighScores
{
    public $scores;
    public $personalBest;
    public $personalTopThree;
    public $latest;

    public function __construct(array $scores)
    {
        $this->scores = $scores;
        $this->latest = $this->scores[count($this->scores) - 1];
        sort($scores);
        $this->setBest($scores);
        $this->setTopThree($scores);
    }

    private function setTopThree(array $scores)
    {
        if (count($scores) > 2) {
            $this->personalTopThree = [$scores[count($scores) - 1], $scores[count($scores) - 2], $scores[count($scores) - 3]];
        } else if (count($scores) > 1) {
            $this->personalTopThree = [$scores[count($scores) - 1], $scores[count($scores) - 2]];
        } else {
            $this->personalTopThree = [$scores[0]];
        }
    }

    private function setBest(array $scores)
    {
        if (count($scores) > 0) {
            $this->personalBest = $scores[count($scores) - 1];
        } else {
            $this->personalBest = $scores[0];
        }
    }

    public function debug()
    {
        #print_r($this->scores);
        # echo $this->latest;
        echo $this->personalBest;
        # print_r($this->personalTopThree);
    }
}

$test = [30];
$high = new HighScores($test);
$high->debug();