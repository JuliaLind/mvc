<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait StraightTrait2
{
    /**
     * @param array<int> $ranks
     */
    private function checkForRanks($ranks, int $minRank): bool
    {
        $maxRank = $minRank + 4;

        for ($rank = $minRank; $rank <= $maxRank; $rank++) {
            if (!array_key_exists($rank, $ranks)) {
                return false;
            }
        }
        return true;
    }
}
