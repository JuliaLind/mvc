<?php

namespace App\ProjectRules;

/**
 * Part of the logic for checking in a Two Pairs rule
 * is possible to score.
 * From kmom10/Project
 */
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
     * @param array<int,int> $ranksDeck - ranks of the cards that will be dealt to the player from the deck during the remaining game
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
