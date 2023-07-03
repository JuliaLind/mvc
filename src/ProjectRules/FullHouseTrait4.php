<?php

namespace App\ProjectRules;

trait FullHouseTrait4
{
    /**
     * From FullHouseTrait6
     *
     * @param bool $three - false if three of the same rank has not been checked before
     * @param int $countRank - number of cards of the same rank
     * @return bool - returns true if three has not been checked previously and
     * the count of a rank is 3 or 4
     */
    abstract private function checkThree(int $three, int $countRank): bool;

    // /**
    //  * From FullHouseTrait5
    //  *
    //  * @param bool $three - true if three of a kind has been found amongst cards
    //  * @param bool $two - true if a pair has been found amongst cards (not including
    //  * the cards in the three)
    //  * @return bool - returns true if both three and two are true
    //  */
    // abstract private function checkBoth(bool $three, bool $two): bool;

    /**
     * Returns true if it is possible to score a FullHouse¨
     * given the ranks in the hand and all ranks (hand + deck)
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksAll
     */
    private function subCheck($ranksHand, $ranksAll): bool
    {
        $three = 0;
        $two = 0;
        foreach (array_keys($ranksHand) as $rank) {
            if ($this->checkThree($three, $ranksAll[$rank])) {
                $three = 1;
            } elseif ($ranksAll[$rank] >= 2) {
                $two = 1;
            }
            if ($two + $three === 2) {
                return true;
            }
        }
        return false;
    }
}
