<?php

namespace App\ProjectRules;

trait TwoPairsTrait13
{
    use TwoPairsTrait9;

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
     * Used in TwoPairsTrait2.
     *
     * Returns true if the number of cards is 2 or 3
     * and the ranks of at least two cards in the hand
     * also are present in the deck
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function check6(array $ranksHand, array $ranksDeck): bool
    {
        $nrOfCards = array_sum($ranksHand);
        return ($nrOfCards <= 3 && $this->threeCardsTwoPairsAlt($ranksHand, $ranksDeck)) || ($nrOfCards <= 2 && $this->matchOneInDeck($ranksHand, $ranksDeck) && max($ranksDeck) >= 2);
    }
}
