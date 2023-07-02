<?php

namespace App\ProjectRules;

trait TwoPairsTrait13
{
    /**
     * From TwoPairsStatTrait9
     *
     * Called if the hand does not already contain
     * a pair and the hand contains two or three cards.
     * Checks if at least two of the ranks present
     * in the hand are also present in the deck
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    abstract private function subCheck6(array $ranksHand, array $ranksDeck): bool;


    /**
     * Used in TwoPairsTrait2.
     *
     * Returns true if the number of cards is 2 or 3
     * and the ranks of at least two cards in the hand
     * also are present in the deck
     * @param array<string> $hand
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function subCheck10(array $hand, array $ranksHand, array $ranksDeck): bool
    {
        return count($hand) <= 3 && $this->subCheck6($ranksHand, $ranksDeck);
    }
}
