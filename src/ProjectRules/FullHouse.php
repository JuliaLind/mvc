<?php

namespace App\ProjectRules;

class FullHouse implements RuleInterface
{
    use AdditionalValueTrait;
    use CountByRankTrait;
    use FirstCheckTrait;
    use FullHouseTrait2;
    use FullHouseTrait3;
    use FullHouseTrait4;
    use FullHouseTrait5;
    use FullHouseTrait6;
    use FullHouseTrait7;
    use FullHouseTrait8;
    use RuleDataTrait;

    public function __construct()
    {
        $this->name = "Full House";
        $this->points = 25;
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

        return count($ranks) === 2 && max($ranks) === 3;
    }
}
