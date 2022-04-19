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

function detectAnagrams(string $word, array $anagrams): array
{
    $res = [];
    foreach ($anagrams as $key) {
        if (isAnagram($word, $key)) {
            array_push($res, $key);
        }
    }

    return $res;
}

/**
 * Compares if $anagram is an anagram of $word
 *
 * @param [string] $word
 * @param [string] $anagram
 * @return boolean
 */
function isAnagram($word, $anagram)
{
    $res = [];
    foreach (mb_str_split(mb_strtolower($word)) as $key) {
        $res[$key] = mb_substr_count(mb_strtolower($word), $key);
    }

    ksort($res);

    $res2 = [];
    foreach (mb_str_split(mb_strtolower($anagram)) as $key) {
        $res2[$key] = mb_substr_count(mb_strtolower($anagram), $key);
    }

    ksort($res2);

    return $res == $res2;
}

#$str = "/[^hola]/i";
#echo (preg_match($str, "loahh")) ? "Encontrado" : "No encontrado";
#$res = preg_replace($str, "", "Hola Mundo");
#echo $res;

print_r(detectAnagrams('ΑΒΓ', ['ΒΓΑ', 'ΒΓΔ', 'γβα']));