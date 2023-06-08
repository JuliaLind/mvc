<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\Card;

/**
 * Royal Flush Rule
 * Ace, King, Queen, Jack, Ten of same suit
 *
 */
class RoyalFlush extends Straight
{
    protected int $maxRank;
    protected int $minRank;

    public function __construct(int $suit=1)
    {
        parent::__construct($suit);
        $this->minRank = 10;
        $this->maxRank = 14;
    }

    /**
     * @param array<int,int> $uniqueRanks
     * @return bool true if rule is fullfilled otherwise false
     */
    protected function evaluateRanks(array $uniqueRanks): bool
    {
        $maxRank = max(array_keys($uniqueRanks));
        $minRank = min(array_keys($uniqueRanks));

        return $maxRank === $this->maxRank && $minRank === $this->minRank;
    }
}
