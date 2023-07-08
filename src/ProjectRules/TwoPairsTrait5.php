<?php

namespace App\ProjectRules;

trait TwoPairsTrait5
{
    private int $additionalValue = 0;

    /**
     * Called in the hand contains 0-2 cards
     * and there is not already a parid in the hand.
     * Checks if the rank of the card
     * matches any of the ranks
     * in the hand and the maximum count of
     * cards of same rank
     * in the deck is two or more
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function checkForTwoPairs1(int $rank, array $ranksHand, array $ranksDeck): bool
    {
        /**
         * @var int $maxRankDeck
         */
        $maxRankDeck = max($ranksDeck);
        if (array_sum($ranksHand) <= 2 && array_key_exists($rank, $ranksHand) && $maxRankDeck >= 2) {
            $this->additionalValue = 1;
            return true;
        }
        return false;
    }

    /**
     * Called when there is only 1 card in hand
     * Returns true if the rank of the dealt card exists in the deck and if
     * the deck contains at lest two cards of same rank. Note that
     * the deck will not contain more than 1 card of the rank because otherwise
     * one of the higher rules would have already returned true.
     * Even if the card already in hand tecnically will not contribute to the rule,
     * the rule is still possible because of the two available slots
     * @param array<int,int> $ranksDeck
     */
    private function checkForTwoPairs3(int $rank, array $ranksDeck): bool
    {
        return array_key_exists($rank, $ranksDeck) && max($ranksDeck) >= 2;
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
        return $this->checkForTwoPairs1($rank, $ranksHand, $ranksDeck) || (array_sum($ranksHand) === 1 && $this->checkForTwoPairs3($rank, $ranksDeck));
    }
}
