<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait RankLimitsTrait
{
    private int $maxRank;
    private int $minRank;

    /**
     * From CountByRankTrait.
     * Returns an associative array
     * where keys are the ranks present amongst
     * the cards and the values are the count of
     * each rank
     * @param array<string> $cards
     * @return  array<array<int|string,int>>
     */
    abstract private function countByRank($cards): array;

    /**
     * Used in the following traits:
     * StraightFlushTrait,
     * StraightTrait,
     *
     * Sets the minRank and maxRank attributes to the
     * min rank in the hand and max rank in the hand.
     * Returns true if the difference between max rank
     * and min rank is no bigger than 4
     * @param array<string> $hand
     */
    private function setRankLimits(array $hand): bool
    {
        /**
         * @var array<int,int> $ranks
         */
        $ranks = $this->countByRank($hand);

        $maxRank = max($ranks);
        $minRank = min($ranks);
        $this->maxRank = $maxRank;
        $this->minRank = $minRank;
        return $maxRank - $minRank <= 4;
    }
}
