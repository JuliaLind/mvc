<?php

namespace App\ProjectRules;

trait FullHouseTrait4
{
    /**
     * Returns true if it is possible to score a FullHouse
     * given the ranks in the hand and all ranks (hand + deck)
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksAll
     */
    private function subCheck($ranksHand, $ranksAll): bool
    {
        $three = 0;
        $two = 0;
        foreach (array_keys($ranksHand) as $rank) {
            if ($three === 0 && $ranksAll[$rank] >= 3) {
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
