<?php

namespace App\ProjectRules;

trait TwoPairsStatTrait6
{
    /**
     * Used in TwoPairsStatTrait
     * Called if the hand does not already contain
     * a pair and checks if the hand contains a card
     * of the same ranks as the dealt card and if the deck
     * contains at least one card of the same rank as any of the
     * cards in deck (note that the deck will not contain
     * the same rank as the dealt card, because otherwise
     * the Three Of A Kind Rule would have already
     * returned true)
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function subCheck3(int $rank, array $ranksHand, array $ranksDeck): bool
    {
        if (array_key_exists($rank, $ranksHand)) {
            foreach($ranksHand as $rank2) {
                if (array_key_exists($rank2, $ranksDeck)) {
                    return true;
                }
            }
        }
        return false;
    }
}
