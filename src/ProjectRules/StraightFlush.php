<?php

namespace App\ProjectRules;

/**
 * Determins if StarightFlush rule is scored
 * or possible to score.
 * From kmom10/Project
 */
class StraightFlush implements RuleInterface
{
    use CountByRankTrait;
    use CountBySuitTrait;
    use CountSuitAndRankTrait;
    use FirstCheckTrait;
    use GroupBySuitTrait;
    use RuleDataTrait;
    use StraightFlushScoredTrait;
    use StraightFlushTrait;
    use StraightFlushTrait3;
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
