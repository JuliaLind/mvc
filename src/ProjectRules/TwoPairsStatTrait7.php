<?php

namespace App\ProjectRules;

trait TwoPairsStatTrait7
{
    /**
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function subCheck3(int $rank, array $ranksHand, array $ranksDeck): bool
    {
        if (array_key_exists($rank, $ranksHand)) {
            foreach($ranksHand as $rank2) {
                if (array_key_exists($rank2, $ranksDeck)) {
                    return true;
                }
            }
        }
        return false;
    }
}
