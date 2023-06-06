<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\Card;

class Straight extends Rule implements RuleInterface
{
    protected int $maxRank;
    protected int $minRank;
    protected int $uniqueRanks = 5;
    protected int $uniqueSuits = 1;

    public function __construct(int $uniqueSuits)
    {
        parent::__construct();
        $this->uniqueSuits = $uniqueSuits;
    }

    /**
     * @param array<int,int> $uniqueRanks
     * @return bool
     */
    protected function evaluateRanks(array $uniqueRanks): bool
    {
        $maxRank = max(array_keys($uniqueRanks));
        $minRank = min(array_keys($uniqueRanks));
        $diff = $maxRank - $minRank;
        if ($diff === $this->uniqueRanks - 1) {
            return true;
        }
        return false;
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
         * @var array<string,int> $uniqueSuits
         */
        $uniqueSuits = $uniqueCount['suits'];
        /**
         * @var array<int,int> $uniqueRanks
         */
        $uniqueRanks = $uniqueCount['ranks'];

        if (count($uniqueSuits) <= $this->uniqueSuits && count($uniqueRanks) === $this->uniqueRanks) {
            $bool = $this->evaluateRanks($uniqueRanks);
        }
        return $bool;
    }
}
