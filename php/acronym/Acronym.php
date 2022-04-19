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

function acronym(string $text): string
{
    $res = "";
    $text = preg_replace("[ ]", "-", $text);
    $txtArray = mb_str_split($text);


    foreach ($txtArray as $key => $value) {
        if (ctype_upper($value) || $value == "С") {
            $res .= $value;
        }
        if ($value == "-" && !ctype_upper($txtArray[$key + 1])) {
            $res .= $txtArray[$key + 1];
        } else if ($value == ":") {
            break;
        }
    }
    if (str_contains($text, "-") === false) {
        return "";
    }
    return mb_strtoupper($res, "UTF-8");
}

//-----------------------------------Debug------------------------------------------------
$text = "Специализированная процессорная часть";
echo acronym($text);
#$text = preg_replace("[ ]", "-", $text);
$txtArray = explode("-", $text);
echo (int)ctype_upper("С");
#echo str_split($txtArray[0])[0];
#echo $text;
#print_r($txtArray);
#echo count($txtArray);