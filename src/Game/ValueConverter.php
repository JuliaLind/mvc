<?php

namespace App\Game;

/**
 * Class representing a Player in the 21 game
 */
class ValueConverter
{
    /**
     * @var int $GOAL the goal points to reach.
     */
    protected const GOAL = 21;

    /**
     * Adjusts if ace should be valued at 14 or at 1
     */
    public function adjAceValue(int $pointSum, int $value): int
    {
        if ($value === 14 && $pointSum + $value > self::GOAL) {
            $value = 1;
        }
        return $value;
    }
}
