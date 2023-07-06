<?php

namespace App\ProjectRules;

trait FullHouseTrait5
{
    /**
     * Called if the hand contains at least two cards of same rank and no other rank. Returns true if any of the following conditions is fulfilled:
     * 1. Hand contains two cards and the deck contains at least three cards of same rank
     * 2. Hand contains two cards and there is at least one card of same rank in the Deck. The deck also contains at least one pair.
     * 3. The hand contains three cards and the deck contains at least two cards of same rank.
     * @param array<int,int> $ranksDeck
     */
    private function check1SubCheck(int $countHand, int $rank, array $ranksDeck): bool
    {
        if ($countHand === 2) {
            return max($ranksDeck) >= 3 || (max($ranksDeck) === 2 && array_key_exists($rank, $ranksDeck));
        }
        return ($countHand === 3 && max($ranksDeck) >= 2);
    }

    /**
     * Used In FullHouseTrait2
     * called if the hand contains more than 1 card.
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
            /**
             * @var int $rank
             */
            $rank = array_key_first($ranksHand);
            /**
             * @var int $countHand
             */
            $countHand = array_sum($ranksHand);
            return $this->check1SubCheck($countHand, $rank, $ranksDeck);
        }
        return false;
    }
}
