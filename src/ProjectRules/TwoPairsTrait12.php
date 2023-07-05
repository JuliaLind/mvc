<?php

namespace App\ProjectRules;

trait TwoPairsTrait12
{
    use TwoPairsTrait7;

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
     * Used in TwoPairsTrait2
     *
     * Returns true if the hand contains two pairs or one pair and it
     * is possible to score two pairs together with the cards in
     * the deck
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function check5(array $ranksHand, array $ranksDeck): bool
    {
        return $this->findSecondPair($ranksHand, $ranksDeck) || $this->matchOneInDeck($ranksHand, $ranksDeck);
    }
}
