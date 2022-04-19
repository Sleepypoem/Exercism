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

function encode(string $input): string
{
    $input .= "-";
    $inputArray = str_split($input);
    $result = "";
    $currentChar = "";
    $nextChar = "";
    $count = 1;

    for ($i = 1; $i < count($inputArray); $i++) {
        $currentChar = $inputArray[$i - 1];
        $nextChar = $inputArray[$i];
        if ($currentChar == $nextChar) {
            $count++;
            if ($i == count($inputArray) - 1) {
                if ($count > 1) {
                    $result .= $count . $currentChar;
                } else {
                    $result .= $currentChar;
                }
            }
        } else if ($currentChar != $nextChar) {
            if ($count > 1) {
                $result .= $count . $currentChar;
            } else {
                $result .= $currentChar;
            }
            $count = 1;
        }
    }


    return $result;
}

function decode(string $input): string
{
    $result = "";
    $count = "";
    $inputArray = str_split($input);
    foreach ($inputArray as $letter) {
        if (!isLetter($letter)) {
            $count .= $letter;
        } else {
            if ($count == "") {
                $count = 1;
            }

            for ($i = 0; $i < (int)$count; $i++) {
                $result .= $letter;
            }
            $count = "";
        }
    }

    return $result;
}

/**
 * sirve para saber si un texto tiene solo letras
 *
 * @param [type] $str
 * @return boolean
 */
function isLetter($str): bool
{
    for ($i = 0; $i < 10; $i++) {
        if (str_contains($str, (string)$i)) {
            return false;
        }
    }
    return true;
}
#echo isLetter("") ? "True" : "False";
echo decode("4A4D3r4s3ert3r2t");
#echo encode('AAAADDDDrrrsssseeertrrrtt');