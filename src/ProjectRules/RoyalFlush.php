<?php

namespace App\ProjectRules;

/**
 * Royal Flush Rule
 * Ace, King, Queen, Jack, Ten of same suit
 *
 */
class RoyalFlush implements RuleInterface
{
    use CountSuitAndRankTrait;

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
