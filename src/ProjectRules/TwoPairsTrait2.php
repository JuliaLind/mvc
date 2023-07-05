<?php

namespace App\ProjectRules;

trait TwoPairsTrait2
{
    use TwoPairsTrait11;
    use TwoPairsTrait12;
    use TwoPairsTrait13;

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
     * Checks if the Two Pairs rule is possible if the
     * dealt card is not placed in hand. (Based on the cards
     * already in hand and the cards in the deck). Note! The
     * hand cannot be empty, for empty hand use the PossibleDeckOnly method
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

        if (array_sum($ranksHand) === 1) {
            return $this->check4($deck, $ranksHand, $ranksDeck);
        }
        if (array_sum($ranksHand) > count($ranksHand)) {
            return $this->check5($ranksHand, $ranksDeck);
        }
        return $this->check6($ranksHand, $ranksDeck);
    }
}
