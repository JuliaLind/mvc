<?php

namespace App\ProjectRules;

class StraightFlush implements RuleInterface
{
    use AdditionalValueTrait;
    use CountByRankTrait;
    use CountBySuitTrait;
    use CountSuitAndRankTrait;
    use FirstCheckTrait;
    use GroupBySuitTrait;
    use RankLimitsTrait;
    use RuleDataTrait;
    use SameSuitTrait;
    use SearchSpecificCardTrait;
    use StraightFlushTrait;
    use StraightFlushTrait2;
    use StraightTrait3;



    public function __construct()
    {
        $this->name = "Straight Flush";
        $this->points = 75;
    }

    /**
     * @param array<string> $hand
     */
    public function scored(array $hand): bool
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
