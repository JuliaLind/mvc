<?php

namespace App\ProjectRules;

/**
 * Determins if the Royal Flush rule is scored or
 * possible to score
 */
class RoyalFlush implements RuleInterface
{
    use AdditionalValueTrait;
    use CountByRankTrait;
    use CountSuitAndRankTrait;
    use FirstCheckTrait;
    use GroupBySuitTrait;
    use RoyalFlushScoredTrait;
    use RoyalFlushTrait;
    use RoyalFlushTrait2;
    use RuleDataTrait;
    use SearchSpecificCardTrait;
    use StraightFlushTrait2;
    use StraightTrait2;

    public function __construct()
    {
        $this->name = "Royal Flush";
        $this->points = 100;
    }
}
