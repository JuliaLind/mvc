<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Trait for checking if an array of numbers contains 5 consequent digits starting with $minRank. Used
 * for checking if a Straight is possible to score
 * given an array of ranks
 */
trait StraightTrait2
{
    /**
     * Used in:
     * StraightTrait3,
     * RoyalFlushTrait2
     *
     * Returns true if a straight where the 'minRank' is the
     * lowest rank is possible in the given ranks,
     * otherwise returns false
     * @param array<int> $ranks
     */
    private function checkForRanks(array $ranks, int $minRank): bool
    {
        $maxRank = $minRank + 4;

        for ($rank = $minRank; $rank <= $maxRank; $rank++) {
            if (!in_array($rank, $ranks)) {
                return false;
            }
        }
        return true;
    }
}
