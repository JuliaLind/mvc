<?php

namespace App\ProjectRules;

trait FullHouseTrait5
{
    /**
     * Used In FullHouseTrait2
     *called if the hand contains more than 1 card.
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
        if (count($ranksHand) === 1) {
            $rank = array_key_first($ranksHand);
            if ($ranksHand[$rank] === 2) {
                if (max($ranksDeck) >= 3) {
                    return true;
                }
                if (max($ranksDeck) === 2 && array_key_exists($rank, $ranksDeck)) {
                    return true;
                }
            }
            return ($ranksHand[$rank] === 3 && max($ranksDeck) >= 2);
        }
        return false;
    }
}
