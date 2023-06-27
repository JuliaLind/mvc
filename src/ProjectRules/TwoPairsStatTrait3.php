<?php

namespace App\ProjectRules;

trait TwoPairsStatTrait3
{
    /**
     * @param array<string> $hand
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function subCheck4($hand, $ranksHand, $ranksDeck): bool
    {
        return (max($ranksHand) === 2 && min($ranksHand) === 2) || (count($hand) <= 3 && max($ranksDeck) >= 2);
    }
}
