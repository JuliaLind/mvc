<?php

namespace App\ProjectRules;

/**
 * Determins if the Royal Flush rule is scored or
 * possible to score
 */
class RoyalFlush implements RuleInterface
{
    use CountSuitAndRankTrait;
    use FirstCheckTrait;
    use RoyalFlushScoredTrait;
    use RoyalFlushTrait;
    use RoyalFlushTrait2;
    use RuleDataTrait;
    use StraightTrait2;

    public function __construct()
    {
        $this->name = "Royal Flush";
        $this->points = 100;
    }
}
