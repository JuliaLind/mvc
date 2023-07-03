<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


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
