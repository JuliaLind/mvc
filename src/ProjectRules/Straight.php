<?php

namespace App\ProjectRules;

class Straight extends Rule implements RuleInterface
{
    protected int $maxRank;
    protected int $minRank;
    protected int $uniqueSuits;

    public function __construct(int $uniqueSuits=4)
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
        return $maxRank - $minRank === 4;
    }

    /**
     * @param array<string> $hand
     */
    public function check(array $hand): bool
    {
        $uniqueCount = $this->cardCounter->count($hand);
        /**
         * @var array<string,int> $uniqueSuits
         */
        $uniqueSuits = $uniqueCount['suits'];
        /**
         * @var array<int,int> $uniqueRanks
         */
        $uniqueRanks = $uniqueCount['ranks'];

        return count($uniqueSuits) <= $this->uniqueSuits && count($uniqueRanks) === 5 && $this->evaluateRanks($uniqueRanks);
    }
}
