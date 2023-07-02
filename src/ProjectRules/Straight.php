<?php

namespace App\ProjectRules;

class Straight implements RuleInterface
{
    use AdditionalValueTrait;
    use CountByRankTrait;
    use FirstCheckTrait;
    use MinRankLimitsTrait;
    use RankLimitsTrait;
    use StraightTrait;
    use StraightTrait2;
    use StraightTrait3;
    use RuleDataTrait;

    public function __construct()
    {
        $this->name = "Straight";
        $this->points = 15;
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
        $maxRank = max(array_keys($ranks));
        $minRank = min(array_keys($ranks));

        return count($ranks) === 5 && ($maxRank - $minRank === 4);
    }
}
