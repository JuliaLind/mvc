<?php

namespace App\ProjectRules;

trait TwoPairsTrait4
{
    use AdditionalValueTrait;

    /**
     * Used in TwoPairsTrait
     *
     * Method called on after ensuring the hand already contains
     * one pair, to check if the card's rank has a
     * match either in the hand or in the deck (cards the
     * player will draw)
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function check1(int $rank, array $ranksHand, array $ranksDeck): bool
    {
        if (array_key_exists($rank, $ranksHand)) {
            $this->additionalValue = 3;
            return true;
        }
        if (array_sum($ranksHand) < 4 && array_key_exists($rank, $ranksDeck)) {
            $this->additionalValue = 2;
            return true;
        }
        return false;
    }
}
