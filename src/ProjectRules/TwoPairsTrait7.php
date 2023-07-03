<?php

namespace App\ProjectRules;

trait TwoPairsTrait7
{
    /**
     * From TwoPairsTrait14
     *
     * Called if the hand already contains one pair
     *
     * Returns true if the hand contains three cards and
     * either the deck contains at least two cards of same rank or
     * at least one card of the same rank as the not paired card
     * in hand (Note the deck will not contain a card of the same
     * rank as the paired card, otherwise one fo the higher rules
     * would have returned true)
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    abstract private function threeCardsTwoPairs(array $ranksHand, array $ranksDeck): bool;

    /**
     * Called if the hand already contains one pair
     * Returns true if the hand contains four cards whereof two pairs
     * @param array<int,int> $ranksHand
     */
    private function fourCardsTwoPairs(array $ranksHand): bool
    {
        return array_sum($ranksHand) === 4 && min($ranksHand) === 2;
    }



    /**
     * Used in TwoPairsStatTrait12
     *
     * Called if the hand already contains a pair.
     * Returns true if either of the following conditions is fulfilled:
     * 1. The hand contains 4 cards of two ranks
     * 2. The hand contains three cards or less and either
     * the deck contains another pair or a card of the same
     * rank as the card in the hand that is not paired
     * a pair or the deck contains
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function findSecondPair($ranksHand, $ranksDeck): bool
    {
        return $this->fourCardsTwoPairs($ranksHand) || $this->threeCardsTwoPairs($ranksHand, $ranksDeck);
    }
}
