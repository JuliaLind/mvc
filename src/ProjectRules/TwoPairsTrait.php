<?php

namespace App\ProjectRules;

trait TwoPairsTrait
{
    /**
     * @param array<string> $cardArray
     */
    public function check3(array $cardArray): bool
    {
        $countUniqueCards = $this->cardCounter->count($cardArray);
        /**
         * @var array<int,int> $rankCount
         */
        $rankCount = $countUniqueCards['ranks'];
        $pairs = 0;
        foreach ($rankCount as $rank) {
            if ($rank >= 2) {
                $pairs += 1;
            }
            if ($pairs === 2) {
                return true;
            }
        }
        return false;
    }
}
