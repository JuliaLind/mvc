<?php

namespace App\ProjectRules;

trait TwoPairsTrait15
{
    /**
     * From TwoPairsTrait8
     *
     * Checks if any of the ranks in the hand is
     * present in the deck.
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    abstract private function matchOneInDeck(array $ranksHand, array $ranksDeck): bool;



    /**
     * Called when there is one card in the hand.
     * Checks if the deck contains at least 1 card of
     * the same rank as the dealt card and if at least one card
     * of the same rank as any of the
     * cards in hand
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function checkForTwoPairs2(int $rank, array $ranksHand, array $ranksDeck): bool
    {
        return array_sum($ranksHand) <= 3 && array_key_exists($rank, $ranksDeck) && $this->matchOneInDeck($ranksHand, $ranksDeck);
    }
}
