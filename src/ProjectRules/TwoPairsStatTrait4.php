<?php

namespace App\ProjectRules;

trait TwoPairsStatTrait4
{
    /**
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function subCheck5(array $ranksHand, array $ranksDeck): bool
    {
        foreach(array_keys($ranksHand) as $rank) {
            if (array_key_exists($rank, $ranksDeck)) {
                return true;
            }
        }
        return false;
    }
}