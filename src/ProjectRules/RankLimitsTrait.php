<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait RankLimitsTrait
{
    private int $maxRank;
    private int $minRank;
    /**
     * @param array<string> $cards
     * @return  array<array<int|string,int>>
     */
    abstract private function countByRank($cards): array;

    /**
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
