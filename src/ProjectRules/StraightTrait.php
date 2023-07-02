<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait StraightTrait
{
    /**
     * From StraightTrait2.
     *
     * Given an array of ranks and the lowest min-rank
     * and the highest min rank that a straight
     * can have, determins if it is possible to
     * achieve a straight
     * @param array<string> $cards
     */
    abstract private function checkAllPossible($cards, int $minMinRank, int $maxMinRank): bool;

    /**
     * From CountByRankTrait.
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
     * From RankLimitsTrait.
     *
     * Sets the minRank and maxRank attributes to the
     * min rank in the hand and max rank in the hand.
     * Returns true if the difference between max rank
     * and min rank is no bigger than 4
     * @param array<string> $hand
     */
    abstract private function setRankLimits(array $hand): bool;

    /**
     * From MinRankLimitsTrait.
     *
     * Sets the minimal rank and the maximal rank
     * that a straight can have considering the cards
     * already in the hand. Minimum rank cannot be
     * lower than highest rank in hand minus 4 (and
     * of course not lower than 2) and
     * cannot be higher than 10
     * @return array<string,int>
     */
    abstract private function minRankLimits(): array;

    /**
     * @param array<string> $hand
     * @param array<string> $deck
     */
    public function possibleWithoutCard(array $hand, array $deck): bool
    {
        $ranks = $this->countByRank($hand);

        if ((count($hand) > count($ranks))) {
            return false;
        }
        $check1 = $this->setRankLimits($hand);
        $minRankLimits = $this->minRankLimits();
        $minMinRank = $minRankLimits['min'];
        $maxMinRank = $minRankLimits['max'];
        $allCards = array_merge($hand, $deck);
        /**
         * @var array<int,int> $ranksAll
         */
        $ranksAll = $this->countByRank($allCards);
        $check2 = $this->checkAllPossible(array_keys($ranksAll), $minMinRank, $maxMinRank);
        return $check1 && $check2;
    }

    /**
     * @param array<string> $deck
     */
    public function possibleDeckOnly(array $deck): bool
    {
        $ranks = $this->countByRank($deck);
        $minMinRank = min(array_keys($ranks));
        $maxMinRank = max(array_keys($ranks)) - 4;
        return $this->checkAllPossible(array_keys($ranks), $minMinRank, $maxMinRank);
    }
}
