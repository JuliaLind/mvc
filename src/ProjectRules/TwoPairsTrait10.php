<?php

namespace App\ProjectRules;

trait TwoPairsTrait10
{
    /**
     * Used in TwoPairsTrait2
     *
     * Called if the card conains only one card.
     * Returns true if the deck contains at least one card
     * of the same rank as the card in hand and at least one pair.
     * Note that the pair in deck will not be of the same rank
     * as the card in hand, otherwise a higher rule would have
     * already returned true
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function subCheck7(array $ranksHand, array $ranksDeck): bool
    {
        return array_key_exists(array_keys($ranksHand)[0], $ranksDeck) && max($ranksDeck) >= 2;
    }
}
