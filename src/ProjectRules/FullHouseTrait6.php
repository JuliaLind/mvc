<?php

namespace App\ProjectRules;

/**
 * Trait contains part of the logic for checking if a full house is possible to score in a hand.
 * From kmom10/Project
 */
trait FullHouseTrait6
{
    /**
     * Used in FullHouseTrait2
     *
     * Returns true is the hand contains 2 or less different ranks
     * and if the maximum number of cards of the same rank in the hand
     * is 3
     * @param array<int,int> $ranksHand
     */
    private function check2($ranksHand): bool
    {
        return count($ranksHand) <= 2 && max($ranksHand) <= 3;
    }
}
