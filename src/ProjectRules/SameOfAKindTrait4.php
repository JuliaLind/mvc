<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait SameOfAKindTrait4
{
    /**
     * @var int $minContRank the minimum number of cards of
     * same rank required to score the rule
     */
    private int $minCountRank;

    private function subCheck(int $countHand, int $countRank): bool
    {
        // return 5 - count($hand) >= $this->minCountRank - $ranksHand[$rank];
        return $countHand >= $this->minCountRank - $countRank;
    }

    private function subCheck2(int $rankCount): bool
    {
        return $rankCount >= $this->minCountRank;
    }
}
