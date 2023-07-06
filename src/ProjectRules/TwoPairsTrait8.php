<?php

namespace App\ProjectRules;

trait TwoPairsTrait8
{
    /**
     * Used in the following traits:
     * TwoPairsTrait6,
     * TwoPairTrait12,
     * TwoPairsTrait13
     *
     * Checks if any of the ranks in the hand is
     * present in the deck.
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function matchOneInDeck(array $ranksHand, array $ranksDeck): bool
    {
        foreach(array_keys($ranksHand) as $rank) {
            if (array_key_exists($rank, $ranksDeck)) {
                return true;
            }
        }
        return false;
    }
}
