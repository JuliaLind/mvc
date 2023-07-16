<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Trait for checking if a Straight Flush rule has been scored.
 * From kmom10/Project
 */
trait StraightFlushScoredTrait
{
    /**
     * From CountSuitAndRankTrait.
     * Returns an associative array containing two
     * associative arrays. The keys of the first array
     * are the ranks present in the cards and the
     * values are the count of each ranks. The second
     * array contains correspoing data for the suits
     * present in the cards.
     * @param array<string> $cards
     * @return array<string,array<array<int|string,int>>>
     */
    abstract private function countSuitAndRank($cards): array;

    /**
     * Used for a full hand and returns
     * true is the rule is scored
     * @param array<string> $hand
     */
    public function scored(array $hand): bool
    {
        $uniqueCount = $this->countSuitAndRank($hand);
        /**
         * @var array<string,int> $suits
         */
        $suits = $uniqueCount['suits'];
        /**
         * @var array<int,int> $ranks
         */
        $ranks = $uniqueCount['ranks'];
        $maxRank = max(array_keys($ranks));
        $minRank = min(array_keys($ranks));

        return count($suits) === 1 && count($ranks) === 5 && ($maxRank - $minRank === 4);
    }
}
