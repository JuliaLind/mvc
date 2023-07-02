<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait StraightTrait3
{
    /**
     * Used in the following traits:
     * StraightTrait,
     *
     * Given an array of ranks and the lowest min-rank
     * and the highest min rank that a straight
     * can have, determins if it is possible to
     * achieve a straight
     * @param array<int> $ranks
     */
    private function checkAllPossible($ranks, int $minMinRank, int $maxMinRank): bool
    {
        $notPossible = false;
        for ($minRank = $minMinRank; $minRank <= $maxMinRank; $minRank++) {
            $maxRank = $minRank - 4;
            for ($rank = $minRank; $rank <= $maxRank; $rank++) {
                $notPossible = !in_array($rank, $ranks);
                if ($notPossible) {
                    break;
                }
            }
        }
        return $notPossible;
    }
}
