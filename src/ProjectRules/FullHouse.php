<?php

namespace App\ProjectRules;

class FullHouse implements RuleInterface
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

        return count($ranks) === 2 && max($ranks) === 3;
    }
}
