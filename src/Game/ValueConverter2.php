<?php

namespace App\Game;

/**
 * Class for checking if adding a card to the hand would return
 * in getting fat. If yes then returns 1, otherwise returns 0
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
