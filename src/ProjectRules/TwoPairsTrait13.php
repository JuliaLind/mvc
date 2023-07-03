<?php

namespace App\ProjectRules;

trait TwoPairsTrait13
{
    /**
     * From TwoPairsTrait9
     *
     * Called if the hand does not already contain
     * a pair and the hand contains two or three cards.
     * Checks if at least two of the ranks present
     * in the hand are also present in the deck
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    abstract private function threeCardsTwoPairsAlt(array $ranksHand, array $ranksDeck): bool;


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
        return ($nrOfCards <= 3 && $this->threeCardsTwoPairsAlt($ranksHand, $ranksDeck)) || ($nrOfCards <= 2 && $this->threeCardsTwoPairsAlt($ranksHand, $ranksDeck, 1) && max($ranksDeck) >= 2);
        // return array_sum($ranksHand) <= 3 && $this->threeCardsTwoPairsAlt($ranksHand, $ranksDeck);
    }
}
