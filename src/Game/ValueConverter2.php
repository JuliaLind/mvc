<?php

namespace App\Game;

/**
 * Class representing a Player in the 21 game
 */
class ValueConverter2
{
    /**
     * @var int $GOAL the goal points to reach.
     */
    protected const GOAL = 21;

    public function checkIfBad(int $minHandValue, int $value): int
    {
        if ($minHandValue + $value > self::GOAL) {
            return 1;
        }
        return 0;
    }
}
