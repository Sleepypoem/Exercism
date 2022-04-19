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

class SimpleCipher
{
    private $keyArr = array(
        "a", "b", "c", "d", "e", "f", "g", "h",
        "i", "j", "k", "l", "m", "n", "o", "p", "q",
        "r", "s", "t", "u", "v", "w", "x", "y", "z",
        "a", "b", "c", "d", "e", "f", "g", "h",
        "i", "j", "k", "l", "m", "n", "o", "p", "q",
        "r", "s", "t", "u", "v", "w", "x", "y", "z",
        "a", "b", "c", "d", "e", "f", "g", "h",
        "i", "j", "k", "l", "m", "n", "o", "p", "q",
        "r", "s", "t", "u", "v", "w", "x", "y", "z"
    );

    public $key = "abcdefghijklmnopqrstuvwxyz";

    private $clavenum = [];
    private $clavetxt = "";

    /**
     * Devuelve una clave aleatoria para cifrar
     *
     * @param string $texto
     * @return string
     */
    private function getClaveAleatoria(string $texto): string
    {
        $salida = $this->clavetxt;

        for ($i = strlen($this->clavetxt); $i < strlen($texto); $i++) {

            #$salida .= $this->keyArr[rand(0, 26)];
            $salida .= $this->keyArr[$i];
        }

        return $salida;
    }

    #se pre-asigna la clave a usar
    public function __construct(string $clave = null)
    {
        if ($clave != null) {
            $arrayKey = str_split($clave, 1);
            $x = 0;
            $y = 0;
            while ($x < count($arrayKey)) {

                if ($y == 26) {
                    throw new InvalidArgumentException("Usa solo letras minusculas de a - z para la clave. Error: " . $arrayKey[$x]);
                }
                if ($arrayKey[$x] == $this->keyArr[$y]) {
                    $this->clavetxt .= $arrayKey[$x];
                    $x++;
                    $y = 0;
                } else {
                    $y++;
                }
            }
            $this->key = $clave;
        } else if ($clave === "") {
            throw new InvalidArgumentException("La clave no puede ser texto vacio");
        } else if ($clave == null) {
            $this->clavetxt = $this->key;
        }
    }

    /**
     * Esta funcion convierte el valor de la variable $clavetxt a un array para poder usar sus indices y sumarlos como la clave
     *
     * @return void
     */
    private function txtANum(): void
    {
        $arrayClave = str_split($this->clavetxt);
        foreach ($arrayClave as $key => $value) {
            array_push($this->clavenum, array_search($value, $this->keyArr));
        }
    }

    /**
     * Codifica el texto dado
     *
     * @param string $plainText
     * @return string
     */
    public function encode(string $plainText): string
    {
        $txtACifrar = str_split($plainText);
        $textoCifrado = "";
        #si la clave no se asigna en el constructor se le asigna aqui una aleatoria
        if (strlen($this->clavetxt) < strlen($plainText)) {
            $this->clavetxt = $this->getClaveAleatoria($plainText);
        }

        $this->txtANum();
        $y = 0;
        $x = 0;
        while ($y < count($this->keyArr) && $x < count($txtACifrar)) {
            #se comparan la letra actual con su correspondiente de la lista de key y se suma su actual posicion con la de la llave correspondiente
            if ($this->keyArr[$y] == $txtACifrar[$x]) {

                $textoCifrado .= $this->keyArr[$y + $this->clavenum[$x]];
                $y = 0;
                $x++;
            } else {
                $y++;
            }
        }
        return $textoCifrado;
    }

    /**
     * Deodifica el texto dado
     *
     * @param string $plainText
     * @return string
     */
    public function decode(string $cipherText): string
    {
        $txtADescifrar = str_split($cipherText);
        $textoDescifrado = "";
        $y = 26;
        $x = 0;
        if (strlen($this->clavetxt) < strlen($cipherText)) {
            $this->clavetxt = $this->getClaveAleatoria($cipherText);
        }
        $this->txtANum();
        while ($y < count($this->keyArr) && $x < count($txtADescifrar)) {

            if ($this->keyArr[$y] == $txtADescifrar[$x]) {

                $textoDescifrado .= $this->keyArr[$y - $this->clavenum[$x]];
                $y = 26;
                $x++;
            } else {
                $y++;
            }
        }
        return $textoDescifrado;
    }
}

$cipher = new SimpleCipher("abgfrts");
$plaintext = 'aaaaaaaaaa';
$ciphertext = 'abcdefghij';
echo $cipher->decode("amkcrgvlz") . " || " . $cipher->encode("alexander");