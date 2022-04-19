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

class School
{
    public $grades = array();
    public function add(string $name, int $grade): void
    {
        if (array_key_exists($grade, $this->grades)) {
            array_push($this->grades[$grade], $name);
        } else {
            $this->grades[$grade] = array();
            array_push($this->grades[$grade], $name);
        }
        sort($this->grades[$grade]);
    }


    public function grade($grade)
    {
        if ($this->grades == null) {
            return $this->grades;
        } else {
            return $this->grades[$grade];
        }
    }


    public function studentsByGradeAlphabetical(): array
    {
        ksort($this->grades);
        return $this->grades;
    }
}



$test = new School();
$test->add('Maria', 2);
$test->add('Carlos', 1);
$test->add('Vanessa', 3);
$test->add('Celica', 5);
$test->add('Marc', 5);
$test->add('Mehdi', 4);
$test->add('Virginie', 5);
$test->add('Claire', 5);
print_r($test->studentsByGradeAlphabetical());