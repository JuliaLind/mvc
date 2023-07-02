<?php

namespace App\ProjectRules;

class SameOfAKind implements RuleInterface
{
    use CountByRankTrait;

    private int $minCountRank;

    /**
     * Constructor
     */
    public function __construct(
        int $minCountRank,
    ) {
        $this->minCountRank = $minCountRank;
    }

    /**
     * @param array<string> $hand
     */
    public function scored(array $hand): bool
    {
        /**
         * @var array<int,int> $ranks
         */
        $ranks = $this->countByRank($hand);

        return max($ranks) >= $this->minCountRank;
    }
}
