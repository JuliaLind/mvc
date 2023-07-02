<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait TwoPairsScoredTrait
{
    /**
     * From CountByRankTrait
     * Returns an associative array
     * where keys are the ranks present amongst
     * the cards and the values are the count of
     * each rank
     * @param array<string> $cards
     * @return  array<array<int|string,int>>
     */
    abstract private function countByRank($cards): array;

    /**
     * Returns true if the TwoPairs rules is scored,
     * otherwise false.
     * @param array<string> $hand
     */
    public function scored(array $hand): bool
    {
        /**
         * @var array<int,int> $ranks
         */
        $ranks = $this->countByRank($hand);
        $counts = array_count_values($ranks);
        return array_key_exists(2, $counts) && $counts[2] === 2;
    }
}
