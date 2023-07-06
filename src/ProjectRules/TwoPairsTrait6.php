<?php

namespace App\ProjectRules;

trait TwoPairsTrait6
{
    private int $additionalValue = 0;

    /**
     * From TwoPairsTrait8
     *
     * Checks if any of the ranks in the hand is
     * present in the deck.
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    abstract private function matchOneInDeck(array $ranksHand, array $ranksDeck): bool;

    /**
     * Used in TwoPairsTrait
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
    private function check3(int $rank, array $ranksHand, array $ranksDeck): bool
    {
        // if (array_sum($ranksHand) <= 3) {
        //     return (array_key_exists($rank, $ranksHand) || array_key_exists($rank, $ranksDeck)) && $this->matchOneInDeck($ranksHand, $ranksDeck);
        // }

        if (array_sum($ranksHand) <= 3 && $this->matchOneInDeck($ranksHand, $ranksDeck)) {
            if (array_key_exists($rank, $ranksHand)) {
                $this->additionalValue = 2;
                return true;
            }
            if (array_key_exists($rank, $ranksDeck)) {
                $this->additionalValue = 1;
                return true;
            }
        }
        return false;
    }
}
