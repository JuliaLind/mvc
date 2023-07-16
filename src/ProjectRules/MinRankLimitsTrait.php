<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Trait for setting the possible lower ranks for checking the possibility of
 * scoreing a Straight or Straight Flush.
 * From kmom10/Project
 */
trait MinRankLimitsTrait
{
    /**
     * Used in traits:
     * StraightTrait,
     *
     * Sets the minimal rank and the maximal rank
     * that a straight can have considering the cards
     * already in the hand. Minimum rank cannot be
     * lower than highest rank in hand minus 4 (and
     * of course not lower than 2) and
     * cannot be higher than 10
     * @return array<string,int>
     */
    private function minRankLimits(int $minRank, int $maxRank): array
    {
        $minMinRank = $maxRank - 4;
        if ($minMinRank < 2) {
            $minMinRank = 2;
        }
        $maxMinRank = $minRank;
        if ($maxMinRank > 10) {
            $maxMinRank = 10;
        }
        return [
            'min' => $minMinRank,
            'max' => $maxMinRank
        ];
    }
}
