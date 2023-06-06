<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\Card;

class Flush extends Rule implements RuleInterface
{
    /**
     * @param array<Card> $hand
     * @return bool true if rule is fullfilled otherwise false
     */
    public function check(array $hand): bool
    {

        $uniqueCount = $this->cardCounter->count($hand);

        /**
         * @var array<string,int> $uniqueSuits
         */
        $uniqueSuits = $uniqueCount['suits'];

        if (count($uniqueSuits) === 1) {
            return true;
        }
        return false;
    }
}
