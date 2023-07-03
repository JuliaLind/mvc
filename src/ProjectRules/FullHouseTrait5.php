<?php

namespace App\ProjectRules;

trait FullHouseTrait5
{
    /**
     * Used In FullHouseTrait2
     *
     * Returns true if the cards in the hand are of the same rank and of the following two
     * conditions is fulfilled:
     * 1. maximum number of cards of same rank in the hand is two and the deck contains
     * at least three cards of same rank
     * 2. maximum number of cards of same rank in the hand is three and the deck contains
     * at least three cards of the same rank
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function check1($ranksHand, $ranksDeck): bool
    {
        return count($ranksHand) === 1 && ((max($ranksHand) === 2 && max($ranksDeck) >= 3) || (max($ranksHand) === 3 && max($ranksDeck) >= 2));
    }
}
