<?php

namespace App\ProjectRules;

class Straight implements RuleInterface
{
    use CountByRankTrait;

    /**
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
