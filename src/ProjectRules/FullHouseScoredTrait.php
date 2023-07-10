<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait FullHouseScoredTrait
{
    /**
     * From CountByRankTrait
     * Returns an associative array
     * where keys are the ranks present amongst
     * the cards and the values are the count of
     * each rank
     * @param array<string> $cards
     * @return array<array<int|string,int>>
     */
    abstract private function countByRank($cards): array;

    /**
     * Returns true if the Full House rule is scored
     * @param array<string> $hand
     */
    public function scored(array $hand): bool
    {
        /**
        * @var array<int,int> $ranks
        */
        $ranks = $this->countByRank($hand);

        return count($hand) === 5 && count($ranks) === 2 && max($ranks) === 3;
    }
}
