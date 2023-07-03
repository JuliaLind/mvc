<?php

namespace App\ProjectRules;

trait TwoPairsTrait11
{
    /**
     * Checks if the array with cards contains at least two pairs
     * @param array<string> $cards
     */
    abstract public function possibleDeckOnly(array $cards): bool;

    /**
     * From TwoPairsTrait10
     *
     * Called if the card conains only one card.
     * Returns true if the deck contains at least one card
     * of the same rank as the card in hand and at least one pair.
     * Note that the pair in deck will not be of the same rank
     * as the card in hand, otherwise a higher rule would have
     * already returned true
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    abstract private function oneCardTwoPairs(array $ranksHand, array $ranksDeck): bool;

    /**
     * Used in TwoPairsTrait2
     * Returns true if the hand contains only one card and
     * either of the following two conditions is fulfilled:
     * 1. The deck contains two pairs
     * 2. The deck contains one pair and one card of
     * the same rank as the card in hand
     *
     * @param array<string> $deck
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function check4(array $deck, array $ranksHand, array $ranksDeck): bool
    {
        // return (array_sum($ranksHand) === 1 && ($this->oneCardTwoPairs($ranksHand, $ranksDeck) || $this->possibleDeckOnly($deck)));
        return $this->oneCardTwoPairs($ranksHand, $ranksDeck) || $this->possibleDeckOnly($deck);
    }
}
