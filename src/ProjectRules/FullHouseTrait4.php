<?php

namespace App\ProjectRules;

trait FullHouseTrait4
{
    /**
     * Used in FullHouseTrait2
     *
     * Returns true if hand contains exactly two ranks and the
     * count of one of the ranks together with the
     * card in deck is at least 3, and correspoding for
     * the other ranks is at least 2
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksAll
     */
    private function check3($ranksHand, $ranksAll): bool
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
