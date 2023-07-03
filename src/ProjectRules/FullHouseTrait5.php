<?php

namespace App\ProjectRules;

trait FullHouseTrait5
{
    /**
     * Used in FullHouseTrait4
     *
     * @param bool $three - true if three of a kind has been found amongst cards
     * @param bool $two - true if a pair has been found amongst cards (not including
     * the cards in the three)
     * @return bool - returns true if both three and two are true
     */
    private function checkBoth(bool $three, bool $two): bool
    {
        return $three && $two;
    }
}
