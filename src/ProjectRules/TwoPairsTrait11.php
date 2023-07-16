<?php

namespace App\ProjectRules;

/**
 * Part of the logic for checking in a Two Pairs rule
 * is possible to score.
 * From kmom10/Project
 */
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
     * @param array<string> $deck - the cards that will be dealt to the user from the deck during the remaining game
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck - ranks of the cards that will be dealt to the player from the deck during the remaining game
     */
    private function check4(array $deck, array $ranksHand, array $ranksDeck): bool
    {
        return $this->oneCardTwoPairs($ranksHand, $ranksDeck) || $this->possibleDeckOnly($deck);
    }
}
