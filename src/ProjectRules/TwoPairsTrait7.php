<?php

namespace App\ProjectRules;

trait TwoPairsTrait7
{
    /**
     * Called if the hand already contains one pair
     * Returns true if the hand contains four cards whereof two pairs
     * @param array<string> $hand
     * @param array<int,int> $ranksHand
     */
    private function fourCardsTwoPairs(array $hand, array $ranksHand): bool
    {
        return count($hand) === 4 && min($ranksHand) === 2;
    }

    /**
     * Returns true if the hand contains three cards and
     * either the deck contains at least two cards of same rank or
     * at least one card of the same rank as the not paired card
     * in hand (Note the deck will not contain a card of the same
     * rank as the paired card, otherwise one fo the higher rules
     * would have returned true)
     * @param array<string> $hand
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function threeCardsTwoPairs(array $hand, array $ranksHand, array $ranksDeck): bool
    {
        /**
         * @var int $rank
         */
        $rank = array_search($ranksHand[min(array_keys($ranksHand))], $hand);
        return count($hand) <= 3 && (array_key_exists($rank, $ranksDeck) || max($ranksDeck) >= 2);
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
     * @param array<string> $hand
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function findSecondPair($hand, $ranksHand, $ranksDeck): bool
    {
        return $this->fourCardsTwoPairs($hand, $ranksHand) || $this->threeCardsTwoPairs($hand, $ranksHand, $ranksDeck);
    }
}
