<?php

namespace App\ProjectRules;

trait TwoPairsTrait2
{
    /**
     * From CountByRankTrait
     * 
     * Returns an associative array
     * where keys are the ranks present amongst
     * the cards and the values are the count of
     * each rank
     * @param array<string> $cards
     * @return  array<array<int|string,int>>
     */
    abstract private function countByRank($cards): array;

    /**
     * Checks if the array with cards contains at least two pairs
     * @param array<string> $cards
     */
    abstract public function possibleDeckOnly(array $cards): bool;

    /**
     * From TwoPairsStatTrait
     * 
     * Called if the hand already contains a pair.
     * Returns true if either of the following conditions is fulfilled:
     * 1. The hand contains 4 cards of two ranks
     * 2. The hand contains three cards or less
     * @param array<string> $hand
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    abstract private function subCheck4($hand, $ranksHand, $ranksDeck): bool;

    /**
     * From TwoPairsStatTrait8
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
    abstract private function subCheck5(array $ranksHand, array $ranksDeck): bool;
    /**
     * From TwoPairsStatTrait9
     * 
     * Called if the hand does not already contain
     * a pair and the hand contains two or three cards.
     * Checks if at least two of the ranks present
     * in the hand are also present in the deck
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    abstract private function subCheck6(array $ranksHand, array $ranksDeck): bool;

    /**
     * From TwoPairsTrait10
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
    abstract private function subCheck7(array $ranksHand, array $ranksDeck): bool;

    /**
     * Checks if the Two Pairs rule is possible if the
     * dealt card is not placed in hand. (Based on the cards
     * already in hand and the cards in the deck). Note! The
     * hand cannot be empty, for empty hand use the check3 method
     * @param array<string> $hand
     * @param array<string> $deck
     */
    public function possibleWithoutCard(array $hand, array $deck): bool
    {
        /**
         * @var array<int,int> $ranksHand
         */
        $ranksHand = $this->countByRank($hand);

        /**
         * @var array<int,int> $ranksDeck
         */
        $ranksDeck = $this->countByRank($deck);

        /**
         * If the hand contains only one card check either if the deck
         * contains two pairs or if the deck contains one pair + a card
         * of the same rank as the card in hand
         */
        if (count($hand) === 1) {
            return $this->subcheck7($ranksHand, $ranksDeck) || $this->possibleDeckOnly($deck);
        }
        if (count($hand) > count($ranksHand)) {
            return $this->subCheck4($hand, $ranksHand, $ranksDeck) || $this->subCheck5($ranksHand, $ranksDeck);
        }
        if (count($hand) <= 3) {
            return $this->subCheck6($ranksHand, $ranksDeck);
        }
        return false;
    }
}
