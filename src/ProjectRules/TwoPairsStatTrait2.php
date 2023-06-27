<?php

namespace App\ProjectRules;

trait TwoPairsStatTrait2
{
    /**
     * @param array<string> $hand
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function subCheck(array $hand, int $rank, array $ranksHand, array $ranksDeck): bool
    {
        if (count($hand) < 4) {
            return array_key_exists($rank, $ranksHand) || array_key_exists($rank, $ranksDeck);
        }
        return array_key_exists($rank, $ranksHand);
    }
}
