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
    use StraightFlushScoredTrait;
    use StraightFlushTrait;
    use StraightFlushTrait2;
    use StraightTrait3;



    public function __construct()
    {
        $this->name = "Straight Flush";
        $this->points = 75;
    }
}
