<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait SameRankSingleStatTrait
{
    /**
     * @var int $minContRank the minimum number of cards of
     * same rank required to score the rule
     */
    protected int $minCountRank;
    protected int $rank;

    protected function checkCountRanks(): bool
    {
        return 5 - count($this->hand) >= $this->minCountRank - $this->ranksHand[$this->rank];
    }
}
