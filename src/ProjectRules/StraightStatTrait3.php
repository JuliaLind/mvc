<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait StraightStatTrait3
{
    /**
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
