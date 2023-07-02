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
    use RoyalFlushTrait;
    use RoyalFlushTrait2;
    use SearchSpecificCardTrait;
    use StraightFlushTrait2;
    use StraightTrait2;
    use RuleDataTrait;

    public function __construct()
    {
        $this->name = "Royal Flush";
        $this->points = 100;
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

        return count($suits) === 1 && count($ranks) === 5 && max(array_keys($ranks)) === 14 && min(array_keys($ranks)) === 10;
    }
}
