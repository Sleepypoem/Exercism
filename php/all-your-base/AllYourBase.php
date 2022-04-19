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

function rebase(int $number, array $sequence, int $base)
{
    #Error handling
    if($sequence == null 
    || $sequence == [0]
    || $sequence[0] == 0){
        return null;
    }else if($number <= 1 || $base <= 1){
        return null;
    }
    
    foreach ($sequence as $k){
        if($k < 0 || $k >= $number){
            return null;
        }
    }
    #Error handling end
    $res = [];
    if ($number == 10) {
        $num = (int)implode($sequence);
    } else {
        $num = to_decimal($number, $sequence);
    }

    while ($num / $base > 0) {
        array_push($res, $num % $base);
        $num = intdiv($num, $base);
    }
    return array_reverse($res);
}

function to_decimal($base, $sequence)
{
    $res = 0;
    $sequence = array_reverse($sequence);

    if (count($sequence) == 1) {
        $count = 0;
    } else {
        $count = count($sequence) - 1;
    }

    for ($i = $count; $i >=  0; $i--) {
        $res += $sequence[$i] * ($base ** $i);
    }
    return $res;
}

#echo to_decimal(8, [1, 3, 3, 6]);
#print_r(rebase(2, [1], 10));
print_r(rebase(2, [1, 2, 0], 0));
#echo 1341 % 2;