<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;

require __DIR__ . "/../../vendor/autoload.php";


trait SameRankTrait
{
    protected CardCounter $cardCounter;

    /**
     * @var int $minCountRank the minimum number of cards of
     * same rank required to score the rule
     */
    protected int $minCountRank;

    /**
     * @param array<string> $hand
     * @return bool true if rule is fullfilled otherwise false
     */
    public function check(array $hand): bool
    {
        $uniqueCount = $this->cardCounter->count($hand);

        /**
         * @var array<int,int> $uniqueRanks
         */
        $uniqueRanks = $uniqueCount['ranks'];

        return max($uniqueRanks) >= $this->minCountRank;
    }
}
