<?php

namespace App\ProjectRules;

trait TwoPairsStatTrait3
{
    /**
     * From CountByRankTrait
     * Returns an associative array
     * where keys are the ranks present amongst
     * the cards and the values are the count of
     * each rank
     * @param array<string> $cards
     * @return  array<array<int|string,int>>
     */
    abstract private function countByRank($cards): array;

    /**
     * Called on by the RuleEvaluator class,
     * but also used in TwoPairsStatTrait2
     * Checks if the array with cards
     * contains at least two pairs
     * @param array<string> $cards
     */
    public function possibleDeckOnly(array $cards): bool
    {
        /**
         * @var array<int,int> $ranks
         */
        $ranks = $this->countByRank($cards);

        $pairs = 0;
        foreach ($ranks as $rankCount) {
            if ($rankCount >= 2) {
                $pairs += 1;
            }
            if ($pairs === 2) {
                return true;
            }
        }
        return false;
    }
}
