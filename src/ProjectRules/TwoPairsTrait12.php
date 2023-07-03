<?php

namespace App\ProjectRules;

trait TwoPairsTrait12
{
    /**
     * From TwoPairsTrait7
     *
     * Called if the hand already contains a pair.
     * Returns true if either of the following conditions is
     * fulfilled:
     * 1. The hand contains 4 cards of two ranks
     * 2. The hand contains three cards or less and either
     * the deck contains another pair or a card of the same
     * rank as the card in the hand that is not paired
     * a pair or the deck contains
     * @param array<string> $hand
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    abstract private function findSecondPair($hand, $ranksHand, $ranksDeck): bool;

    /**
     * From TwoPairsTrait8
     *
     * Called in the hand already contains a pair.
     * Checks if any of the cards in the hand is
     * present in the deck. Note that the deck will
     * not contain the same rank as the pair in
     * the hand, because the otherwise the Three
     * Of A kind rulw would already have returned
     * true
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    abstract private function matchOneInDeck(array $ranksHand, array $ranksDeck): bool;



    /**
     * Used in TwoPairsTrait2
     *
     * Returns true if the hand contains two pairs or it
     * is possible to score two pairs together with the cards in
     * the deck
     * @param array<string> $hand
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function check5(array $hand, array $ranksHand, array $ranksDeck): bool
    {
        return count($hand) > count($ranksHand) && ($this->findSecondPair($hand, $ranksHand, $ranksDeck) || $this->matchOneInDeck($ranksHand, $ranksDeck));
    }
}
