<?php

namespace App\ProjectRules;

trait FullHouseTrait2
{
    /**
     * From FullhouseTrait3
     *
     * Returns true if the deck contains at least
     * 3 cards of the same rank and at leat two cards
     * of same (other) rank
     * @param array<string> $deck
     */
    abstract public function possibleDeckOnly(array $deck): bool;

    /**
     * From FullHouseTrait4
     *
     * Returns true if it is possible to score a FullHouse
     * given the ranks in the hand and all ranks (hand + deck)
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksAll
     */
    abstract private function check3($ranksHand, $ranksAll): bool;

    /**
     * From FullHouseTrait6
     *
     * Returns true is the hand contains 2 or less different ranks
     * and if the maximum number of cards of the same rank in the hand
     * is 3
     * @param array<int,int> $ranksHand
     */
    abstract private function check2($ranksHand): bool;

    /**
     * From FullHouseTrait5
     *
     * Returns true if the cards in the hand are of the same rank and of the following two
     * conditions is fulfilled:
     * 1. maximum number of cards of same rank in the hand is two and the deck contains
     * at least three cards of same rank
     * 2. maximum number of cards of same rank in the hand is three and the deck contains
     * at least three cards of the same rank
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    abstract private function check1($ranksHand, $ranksDeck): bool;

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
     * Returns true if a rule is possible to score
     * given the cards in the deck and the cards
     * that will be dealt from deck
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

        $allCards = array_merge($hand, $deck);
        /**
         * @var array<int,int> $ranksAll
         */
        $ranksAll = $this->countByRank($allCards);

        if (count($hand) === 1) {
            $rank = array_key_first($ranksHand);
            return in_array($rank, array_keys($ranksDeck)) && $this->possibleDeckOnly($allCards);
        }
        return $this->check1($ranksHand, $ranksDeck) || ($this->check2($ranksHand) && $this->check3($ranksHand, $ranksAll));
    }
}
