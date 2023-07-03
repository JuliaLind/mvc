<?php

namespace App\ProjectRules;

trait TwoPairsTrait9
{
    /**
     * Used in TwoPairsTrait13
     * Called if the hand does not already contain
     * a pair and the hand contains two or three cards.
     *  Checks if at least two of the ranks present
     *  in the hand are also present in the deck
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function threeCardsTwoPairsAlt(array $ranksHand, array $ranksDeck): bool
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
