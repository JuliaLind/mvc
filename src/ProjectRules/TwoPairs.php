<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\Card;

class TwoPairs extends Rule implements RuleInterface
{
    protected int $minCountRank;
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->minCountRank = 2;
    }

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

        $minCountRank = $this->minCountRank;
        $pairs = 0;
        foreach($uniqueRanks as $rankCount) {
            // the hand should not contain more than 2 of same
            // rank because four of a kind and three of a kind
            // will be checked before two pairs
            if ($rankCount >= $minCountRank) {
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
