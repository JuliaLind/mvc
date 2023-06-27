<?php

namespace App\ProjectRules;

trait TwoPairsStatTrait5
{
    /**
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function subCheck6(array $ranksHand, array $ranksDeck): bool
    {
        $pairs = 0;
        foreach(array_keys($ranksHand) as $rank) {
            if (array_key_exists($rank, $ranksDeck)) {
                $pairs += 1;
            }
            if ($pairs === 2) {
                return true;
            }
        }
        return false;
    }
}
