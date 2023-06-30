<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


// KANSKE TA BOR DENNA

trait SameRankTrait
{
    /**
     * @var int $minCountRank the minimum number of cards of
     * same rank required to score the rule
     */
    private int $minCountRank;
    /**
     * @param array<string> $cards
     * @return array<int,int>
     */
    abstract private function countByRank($cards): array;

    /**
     * @param array<string> $hand
     */
    public function check(array $hand): bool
    {
        /**
         * @var array<int,int> $uniqueRanks
         */
        $ranks = $this->countByRank($hand);

        return max($ranks) >= $this->minCountRank;
    }
}
