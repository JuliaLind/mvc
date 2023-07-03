<?php

namespace App\ProjectRules;

trait TwoPairsTrait8
{
    /**
     * Used in the following traits:
     * TwoPairTrait12,
     * TwoPairsTrait6,
     * TwoPairsTrait13
     *
     * Called in the hand already contains a pair.
     * Checks if any of the cards in the hand is
     * present in the deck. Note that the deck will
     * not contain the same rank as the pair in
     * the hand, because the otherwise the Three
     * Of A kind rulw would already have returned
     * true
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
