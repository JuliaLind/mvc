<?php

namespace App\Game;

/**
 * Class for contering the value of Ace from 14 to 1 when a hand reaches over 21 points
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
