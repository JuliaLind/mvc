<?php

namespace App\ProjectRules;

/**
 * Royal Flush Rule
 * Ace, King, Queen, Jack, Ten of same suit
 *
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
