<?php

namespace App\ProjectRules;

class StraightFlush implements RuleInterface
{
    use CountSuitAndRankTrait;

    /**
     * @param array<string> $hand
     */
    public function check(array $hand): bool
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
