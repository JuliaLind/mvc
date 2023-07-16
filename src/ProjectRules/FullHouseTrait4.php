<?php

namespace App\ProjectRules;

/**
 * Trait for checking if the ranks in hand, together withthe ranks in
 * deck result in three of one rank and two of the other.
 * From kmom10/Project
 */
trait FullHouseTrait4
{
    /**
     * Used in FullHouseTrait2
     *
     * Returns true if hand contains exactly two ranks and the
     * count of one of the ranks together with the
     * card in deck is at least 3, and correspoding for
     * the other ranks is at least 2
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksAll - ranks of the cards in the hand and the cards from the deck that will be dealt to the player during the remaining game
     */
    private function check3($ranksHand, $ranksAll): bool
    {
        $three = 0;
        $two = 0;
        foreach (array_keys($ranksHand) as $rank) {
            if ($three === 0 && $ranksAll[$rank] >= 3) {
                $three = 1;
            } elseif ($ranksAll[$rank] >= 2) {
                $two = 1;
            }
            if ($two + $three === 2) {
                return true;
            }
        }
        return false;
    }
}
