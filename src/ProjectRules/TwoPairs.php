<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\Card;

class TwoPairs extends Rule implements RuleInterface
{
    // protected int $minCountRank;
    // /**
    //  * Constructor
    //  */
    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->minCountRank = 2;
    // }

    /**
     * @param array<Card> $hand
     * @return bool true if rule is fullfilled otherwise false
     */
    public function check(array $hand): bool
    {
        $bool = false;
        $uniqueCount = $this->cardCounter->count($hand);

        /**
         * @var array<int,int> $uniqueRanks
         */
        $uniqueRanks = $uniqueCount['ranks'];

        // $minCountRank = $this->minCountRank;
        $pairs = 0;
        foreach($uniqueRanks as $rankCount) {
            if ($rankCount >= 2) {
                $pairs += 1;
            }
            if ($pairs === 2) {
                $bool = true;
                break;
            }
        }
        return $bool;
    }
}
