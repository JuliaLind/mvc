<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Trait for checking if a Straight has been scored in a hand.
 * From kmom10/Project
 */
trait StraightScoredTrait
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
     * Used for a full hand and returns
     * true is the rule is scored
     * @param array<string> $hand
     */
    public function scored(array $hand): bool
    {
        /**
         * @var array<int,int> $ranks
         */
        $ranks = $this->countByRank($hand);
        $maxRank = max(array_keys($ranks));
        $minRank = min(array_keys($ranks));

        return count($ranks) === 5 && ($maxRank - $minRank === 4);
    }
}
