<?php

namespace App\ProjectRules;

trait TwoPairsTrait14
{
    /**
     * Used in TwoPairsTrait7
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
    private function threeCardsTwoPairs(array $ranksHand, array $ranksDeck): bool
    {
        /**
         * @var int $rank
         */
        $rank = array_search(min($ranksHand), $ranksHand);
        return array_sum($ranksHand) <= 3 && (array_key_exists($rank, $ranksDeck) || max($ranksDeck) >= 2);
    }
}
