<?php

namespace App\ProjectRules;

/**
 * Class for determining if a full hand has scored
 * the Two Pairs Rule.
 */
class TwoPairs implements RuleInterface
{
    use CountByRankTrait;

    /**
     * Returns true if the TwoPairs rules is scored,
     * otherwise false.
     * @param array<string> $hand
     */
    public function scored(array $hand): bool
    {
        /**
         * @var array<int,int> $ranks
         */
        $ranks = $this->countByRank($hand);
        $counts = array_count_values($ranks);
        return array_key_exists(2, $counts) && $counts[2] === 2;
    }
}
