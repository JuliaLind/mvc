<?php

namespace App\ProjectRules;

/**
 * Determins if StarightFlush rule is scored
 * or possible to score
 */
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
    use StraightFlushTrait3;
    use StraightTrait2;
    use StraightTrait3;

    /**
     * Counstructor
     */
    public function __construct()
    {
        $this->name = "Straight Flush";
        $this->points = 75;
    }
}
