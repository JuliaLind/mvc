<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait SameOfAKindTrait4
{
    /**
     * @var int $minCountRank the minimum number of cards of
     * same rank required to score the rule
     */
    private int $minCountRank;

    /**
     * Used in:
     * SameOfAKindTrait,
     * SameOfAKindTrait2
     *
     * Returns true if there is enough empty slots left in hand to fit
     * the difference between the count of a rank in the hand and the
     * minimum count of same rank required to score the rule
     */
    private function enoughSpaceInHand(int $countHand, int $countRank): bool
    {
        return 5 - $countHand >= $this->minCountRank - $countRank;
    }

    /**
     * Used in:
     * SameOfAKindTrait,
     * SameOfAKindTrait2
     *
     * Returns true if the count of rank is the same
     * or exceeds the minimum count of same rank required
     * to score the rule
     */
    private function requiredCount(int $rankCount): bool
    {
        return $rankCount >= $this->minCountRank;
    }
}
