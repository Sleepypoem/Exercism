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

class Robot
{
    /**
     *
     * @var int[]
     */
    public $position;

    /**
     *
     * @var string
     */
    protected $direction = [];

    const DIRECTION_NORTH = [0, 1];
    const DIRECTION_EAST = [1, 0];
    const DIRECTION_SOUTH = [0, -1];
    const DIRECTION_WEST = [-1, 0];

    public function __construct(array $position, $direction)
    {
        $this->position = $position;
        $this->direction = $direction;
    }

    public function turnRight(): self
    {
        switch ($this->direction) {
            case Robot::DIRECTION_NORTH:
                $this->direction = Robot::DIRECTION_EAST;
                break;

            case Robot::DIRECTION_EAST:
                $this->direction = Robot::DIRECTION_SOUTH;
                break;

            case Robot::DIRECTION_SOUTH:
                $this->direction = Robot::DIRECTION_WEST;
                break;

            case Robot::DIRECTION_WEST:
                $this->direction = Robot::DIRECTION_NORTH;
                break;

            default:
                echo "Unknown Direction";
                break;
        }

        return $this;
    }

    public function turnLeft(): self
    {
        switch ($this->direction) {
            case Robot::DIRECTION_NORTH:
                $this->direction = Robot::DIRECTION_WEST;
                break;

            case Robot::DIRECTION_EAST:
                $this->direction = Robot::DIRECTION_NORTH;
                break;

            case Robot::DIRECTION_SOUTH:
                $this->direction = Robot::DIRECTION_EAST;
                break;

            case Robot::DIRECTION_WEST:
                $this->direction = Robot::DIRECTION_SOUTH;
                break;

            default:
                echo "Unknown direction";
                break;
        }

        return $this;
    }

    public function advance(): self
    {
        $this->position[0] += $this->direction[0];
        $this->position[1] += $this->direction[1];

        return $this;
    }

    public function instructions(string $inst)
    {
        foreach (str_split($inst) as $key => $value) {
            switch ($value) {
                case 'L':
                    $this->turnLeft();
                    break;

                case 'R':
                    $this->turnRight();
                    break;

                case 'A':
                    $this->advance();
                    break;

                default:
                    throw new InvalidArgumentException("Unknown instruction: \"" . $value . "\"");

                    break;
            }
        }
    }
}

$robot = new Robot([0, 0], Robot::DIRECTION_NORTH);
$robot->instructions('LX');
print_r($robot->position);