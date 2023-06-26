<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;

class TwoPairs extends Rule implements RuleInterface
{
    use TwoPairsTrait;
    /**
     * @param array<string> $hand
     * @return bool true if rule is fullfilled otherwise false
     */
    public function check(array $hand): bool
    {
        return $this->check3($hand);
        // $uniqueCount = $this->cardCounter->count($hand);

        // /**
        //  * @var array<int,int> $uniqueRanks
        //  */
        // $uniqueRanks = $uniqueCount['ranks'];

        // $pairs = 0;
        // foreach($uniqueRanks as $rankCount) {
        //     if ($rankCount >= 2) {
        //         $pairs += 1;
        //     }
        // }
        // return $pairs === 2;
    }
}
