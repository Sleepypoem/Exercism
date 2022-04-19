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

class Bob
{

    public function respondTo(string $str): string
    {
        #this line verify if the string is empty
        $blank = strlen(trim(preg_replace('/\xc2\xa0/', ' ', $str))) == 0;
        #this line verify if the string ends with a "?" removing all white spaces at the end
        $isQuestion = str_ends_with(trim($str), "?");

        if ($blank) {
            return "Fine. Be that way!";
        } else if ($this->containsOnlyCapitals($str) && $isQuestion) {
            return "Calm down, I know what I'm doing!";
        } else if ($this->containsOnlyCapitals($str)) {
            return "Whoa, chill out!";
        } else if ($isQuestion) {
            return "Sure.";
        }

        return "Whatever.";
    }



    /**
     * Returns true only and only if the given string contains letters and all capitals, else it returns false
     *
     * @param [type] $str the string to analyze
     * @return bool
     */
    private function containsOnlyCapitals($str): bool
    {
        #this line replaces all non-letters characters with blank spaces to make sure there is only letters
        $str = mb_ereg_replace("[^A-Za-z]", "", $str);
        $lettersLow = "abcdefghijklmnopqrstuvwxyz";
        if ($str == "") {
            return false;
        } else {
            foreach (str_split($lettersLow) as $letter => $value) {
                if (str_contains($str, $value)) {
                    return false;
                }
            }
        }

        return true;
    }
}

$bob = new Bob();
echo $bob->respondTo("Okay if like my  spacebar  quite a bit?   no");
#$bob->containsOnlyCapitals("1,") ? print("true") : print("false");
#$cadena = "ZOMG THE %^*@#$(*^ ZOMBIwwwwwwES AReeeeE COMING!!11!!1!";
#$nueva_cadena = mb_ereg_replace("[^A-Za-z]", "", $cadena);
#echo $nueva_cadena;