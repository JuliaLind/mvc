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
     * From TwoPairsTrait11.
     *
     * Returns true if the hand contains only one card and
     * either of the following two conditions is fulfilled:
     * 1. The deck contains two pairs
     * 2. The deck contains one pair and one card of
     * the same rank as the card in hand
     *
     * @param array<string> $hand
     * @param array<string> $deck
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    abstract private function check4(array $hand, array $deck, array $ranksHand, array $ranksDeck): bool;

    /**
     * From TwoPairsTrait12
     *
     * Returns true if the hand contains two pairs or it
     * is possible to score two pairs together with the cards in
     * the deck
     * @param array<string> $hand
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    abstract private function check5(array $hand, array $ranksHand, array $ranksDeck): bool;

    /**
     * From TwoPairsTrait13.
     *
     * Returns true if the number of cards is 2 or 3
     * and the ranks of at least two cards in the hand
     * also are present in the deck
     * @param array<string> $hand
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    abstract private function check6(array $hand, array $ranksHand, array $ranksDeck): bool;

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

        return $this->check4($hand, $deck, $ranksHand, $ranksDeck) || $this->check5($hand, $ranksHand, $ranksDeck) || $this->check6($hand, $ranksHand, $ranksDeck);
        // if (count($hand) === 1) {
        //     return $this->subcheck7($ranksHand, $ranksDeck) || $this->possibleDeckOnly($deck);
        // }
        // if (count($hand) > count($ranksHand)) {
        //     return $this->subCheck4($hand, $ranksHand, $ranksDeck) || $this->subCheck5($ranksHand, $ranksDeck);
        // }
        // if (count($hand) <= 3) {
        //     return $this->subCheck6($ranksHand, $ranksDeck);
        // }
        // return false;
    }
}
