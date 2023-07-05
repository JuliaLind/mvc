<?php

namespace App\ProjectRules;

trait TwoPairsTrait11
{
    use TwoPairsTrait3;
    use TwoPairsTrait10;

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
        return $this->oneCardTwoPairs($ranksHand, $ranksDeck) || $this->possibleDeckOnly($deck);
    }
}
