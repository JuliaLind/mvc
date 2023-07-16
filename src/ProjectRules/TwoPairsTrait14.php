<?php

namespace App\ProjectRules;

/**
 * Part of the logic for checking in a Two Pairs rule
 * is possible to score.
 * From kmom10/Project
 */
trait TwoPairsTrait14
{
    /**
     * Used in TwoPairsTrait7
     *
     * Called if the hand already contains one pair
     *
     * Returns true if the hand contains three or two cards and
     * either the deck contains at least two cards of same rank or
     * at least one card of the same rank as the not paired card
     * in hand (Note the deck will not contain a card of the same
     * rank as the paired card, otherwise one fo the higher rules
     * would have returned true)
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck - ranks of the cards that will be dealt to the player from the deck during the remaining game
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
