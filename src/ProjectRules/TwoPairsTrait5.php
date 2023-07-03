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
     * the same rank as the dealt card and if at least one card
     * of the same rank as any of the
     * cards in hand
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function checkForTwoPairs2(int $rank, array $ranksHand, array $ranksDeck): bool
    {
        return array_key_exists($rank, $ranksDeck) && array_key_exists(array_keys($ranksHand)[0], $ranksDeck);
    }

    /**
     * Called when there is only 1 card in hand
     * Returns true if the rank of the dealt card exists in the deck and if
     * the deck contains at lest two cards of same rank. Note that
     * the deck will not contain more than 1 card of the rank because otherwise
     * one of the higher rules would have already returned true
     * @param array<int,int> $ranksDeck
     */
    private function checkForTwoPairs3(int $rank, array $ranksDeck): bool
    {
        return (array_key_exists($rank, $ranksDeck) && max($ranksDeck) >= 2);
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
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function check2(int $rank, array $ranksHand, array $ranksDeck): bool
    {
        return array_sum($ranksHand) === 1 && ($this->checkForTwoPairs1($rank, $ranksHand, $ranksDeck) || $this->checkForTwoPairs2($rank, $ranksHand, $ranksDeck) || $this->checkForTwoPairs3($rank, $ranksDeck));
    }
}
