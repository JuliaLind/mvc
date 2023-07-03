<?php

namespace App\ProjectRules;

trait FullHouseTrait6
{
    /**
     * Used in FullHouseTrait4
     *
     * @param bool $three - false if three of the same rank has not been checked before
     * @param int $countRank - number of cards of the same rank
     * @return bool - returns true if three has not been checked previously and
     * the count of a rank is 3 or 4
     */
    private function checkThree(bool $three, int $countRank): bool
    {
        return $three === false && $countRank >= 3;
    }
}
