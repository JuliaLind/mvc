<?php

namespace App\ProjectRules;

/**
 * Part of the logic for checking in a Two Pairs rule
 * is possible to score.
 * From kmom10/Project
 */
trait TwoPairsTrait12
{
    use TwoPairsTrait7;

    /**
     * From TwoPairsTrait8
     *
     * Checks if any of the ranks in the hand is
     * present in the deck.
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck - ranks of the cards that will be dealt to the player from the deck during the remaining game
     */
    abstract private function matchOneInDeck(array $ranksHand, array $ranksDeck): bool;



    /**
     * Used in TwoPairsTrait2
     *
     * Returns true if the hand contains two pairs or one pair and it
     * is possible to score two pairs together with the cards in
     * the deck
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck - ranks of the cards that will be dealt to the player from the deck during the remaining game
     */
    private function check5(array $ranksHand, array $ranksDeck): bool
    {
        return $this->findSecondPair($ranksHand, $ranksDeck) || $this->matchOneInDeck($ranksHand, $ranksDeck);
    }
}
