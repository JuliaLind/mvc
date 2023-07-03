<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait StraightTrait3
{
    /**
     * From StraightTrait2
     * Returns true if a straight where the 'minRank' is the
     * lowest rank is possible in the given ranks,
     * otherwise returns false
     * @param array<int> $ranks
     */
    abstract private function checkForRanks(array $ranks, int $minRank): bool;

    /**
     * Used in the following traits:
     * StraightTrait,
     * StraightFlushTrait
     *
     * Given an array of ranks and the lowest min-rank
     * and the highest min-rank that a straight
     * can have, determins if it is possible to
     * achieve a straight
     * @param array<int> $ranks
     */
    private function checkAllPossible($ranks, int $minMinRank, int $maxMinRank): bool
    {
        $possible = true;
        for ($minRank = $minMinRank; $minRank <= $maxMinRank; $minRank++) {
            $possible = $this->checkForRanks($ranks, $minRank);
        }
        return $possible;
    }
}
