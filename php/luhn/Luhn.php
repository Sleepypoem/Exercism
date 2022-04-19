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

function isValid(string $number): bool
{
    #revisa si hay espacios en blanco antes del numero a verificar tambien que no haya simbolos
    if (!onlyNumbers($number) || strlen(ltrim($number, " ")) <= 1) {
        return false;
    }

    $result = [];
    #elimina todo lo que no sean numeros del string
    #$number = mb_ereg_replace("[^0-9]", "", $number);
    $numArr = str_split(mb_ereg_replace("[^0-9]", "", $number));

    for ($i = count($numArr) - 1; $i >= 0; $i--) {
        if ($i % 2 != 0 || $i == 0) {
            $numArr[$i] *= 2;
        }

        if ($numArr[$i] > 9) {
            $numArr[$i] = $numArr[$i] - 9;
        }
        array_push($result, $numArr[$i]);
    }

    if (array_sum($result) % 10 == 0) {
        return true;
    } else {
        return false;
    }
}

function onlyNumbers($number): bool
{
    $invalid = "abcdefghijklmnopqrstuvwxyz-£$";
    if ($number == "") {
        return false;
    }
    foreach (str_split($invalid) as $n => $v) {
        if (str_contains($number, $v) || str_contains($number, strtoupper($v))) {
            return false;
        }
    }
    return true;
}
isValid("59") ? print("true") : print("false");
#(int)isValid("59");
#echo (int)onlyNumbers("59");
#echo 0 % 2;