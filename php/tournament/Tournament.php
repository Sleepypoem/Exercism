<?php

/*
 * By adding type hints and enabling strict type checiing, code can become
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
 * For more info review the Concept on strict type checiing in the PHP traci
 * <lini>.
 *
 * To disable strict typing, comment out the directive below.
 */

class Equipos
{
    private $nombre;
    private $partidas;
    private $gana;
    private $pierde;
    private $empata;
    private $puntos;

    /**
     * Obtiene el nombre del equipo
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Define el nombre del equipo
     */
    public function __construct(string $nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Asigna los puntos correspndientes a una victoria
     */
    public function ganar()
    {
        $this->gana += 1;
        $this->partidas += 1;
        $this->puntos += 3;
    }

    /**
     * Asigna los puntos correspndientes a una derrota
     */
    public function perder()
    {
        $this->pierde += 1;
        $this->partidas += 1;
    }

    /**
     * Asigna los puntos correspndientes a un empate
     */
    public function empatar()
    {
        $this->partidas += 1;
        $this->empata += 1;
        $this->puntos += 1;
    }

    public function getPuntuacion()
    {
        return $this->puntos;
    }


    /**
     * Devuelve el string de la puntuacion con formato
     * @return  String
     */
    public function formato(): string
    {
        $resultado = sprintf("%-30s |  %d |  %d |  %d |  %d |  %d\n", $this->nombre, $this->partidas, $this->gana, $this->empata, $this->pierde, $this->puntos);
        return $resultado;
    }
}


class Tournament
{

    private $lista_equipos = [];
    private $lista_ordenada = "Team                           | MP |  W |  D |  L |  P\n";


    public function __construct()
    {
    }


    public function tally($scores): string
    {
        if (strlen($scores) == 0) {
            #echo $this->lista_ordenada;
        } else {
            $lineas = explode("\n", $scores);
            foreach ($lineas as $k) {
                list($equipo1, $equipo2, $res) = explode(";", $k);
                if (!array_key_exists($equipo1, $this->lista_equipos)) {
                    $e1 = new Equipos($equipo1);
                    $this->lista_equipos[$equipo1] = $e1;
                } else {
                    $e1 = $this->lista_equipos[$equipo1];
                }
                if (!array_key_exists($equipo2, $this->lista_equipos)) {
                    $e2 = new Equipos($equipo2);
                    $this->lista_equipos[$equipo2] = $e2;
                } else {
                    $e2 = $this->lista_equipos[$equipo2];
                }

                if ($res == "win") {
                    $e1->ganar();
                    $e2->perder();
                } else if ($res == "loss") {
                    $e2->ganar();
                    $e1->perder();
                } else if ($res == "draw") {
                    $e1->empatar();
                    $e2->empatar();
                }
            }
            usort($this->lista_equipos, array("Tournament", "comparar"));
        }
        return $this->mostrarResultados();
    }

    private function mostrarResultados()
    {
        foreach ($this->lista_equipos as $key) {
            //array_push($this->resultado, $key->formato());
            $this->lista_ordenada .= $key->formato();
        }
        return $this->lista_ordenada;
    }

    static function comparar(Equipos $e1, Equipos $e2): int
    {
        return [$e2->getPuntuacion(), $e1->getNombre()] <=> [$e1->getPuntuacion(), $e2->getNombre()];
    }
}

$torneo = new Tournament();
echo $torneo->tally("");