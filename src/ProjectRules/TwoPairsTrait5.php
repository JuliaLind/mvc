<?php

namespace App\ProjectRules;

trait TwoPairsTrait5
{
    /**
     * Called when there is one card in the hand.
     * Checks if the card in the hand is of the
     * same rank as the dealt card and if the deck
     * contains at least two cards of same rank (any)
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function checkForTwoPairs1(int $rank, array $ranksHand, array $ranksDeck): bool
    {
        /**
         * @var int $maxRankDeck
         */
        $maxRankDeck = max($ranksDeck);
        return (array_key_exists($rank, $ranksHand) && $maxRankDeck >= 2);
    }

    /**
     * Called when there is one card in the hand.
     * Checks if the deck contains at least 1 card of
     * the same rank as the dealt card and if the rank
     * and at least one card of the same ranks as the
     * card in hand
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function checkForTwoPairs2(int $rank, array $ranksHand, array $ranksDeck): bool
    {
        return array_key_exists($rank, $ranksDeck) && array_key_exists(array_keys($ranksHand)[0], $ranksDeck);
    }

    /**
     * Used in TwoPairsTrait
     * Called on if the hand does not already
     * contains a pair and returns true if the hand
     * contains only 1 card and one of the following is
     * fulfilled:
     * 1. either the card in hand is of same rank as
     * the dealt card and the deck contains at least
     * one pair
     * 2. the deck contains at least one card of the
     * same rank as the card in the hand and at least
     * one card of the same rank as the dealt card
     * @param array<string> $hand
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function check2(array $hand, int $rank, array $ranksHand, array $ranksDeck): bool
    {
        return count($hand) === 1 && ($this->checkForTwoPairs1($rank, $ranksHand, $ranksDeck) || $this->checkForTwoPairs2($rank, $ranksHand, $ranksDeck));
    }
}
