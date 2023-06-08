<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\Card;

class FullHouse extends Rule implements RuleInterface
{
    /**
     * @param array<Card> $hand
     * @return bool true if rule is fullfilled otherwise false
     */
    public function check(array $hand): bool
    {
        $uniqueCount = $this->cardCounter->count($hand);

        /**
         * @var array<int,int> $uniqueRanks
         */
        $uniqueRanks = $uniqueCount['ranks'];

        $countDistinct = count($uniqueRanks);

        $rankCountMax = max($uniqueRanks);

        return $countDistinct === 2 && $rankCountMax === 3;
    }
}
