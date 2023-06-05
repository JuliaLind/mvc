<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\Card;

/**
 * Straight Flush Rule
 * Any five subsequent ranks between 2 - Ace(14) of same suit
 *
 */
class StraightFlush extends Rule implements RuleInterface
{
    /**
     * @var int $UNIQUERANKS
     */
    protected const UNIQUERANKS = 5;

    /**
     * @var int $UNIQUESUITS
     */
    protected const UNIQUESUITS = 1;

    /**
     * @param array<int,int> $uniqueRanks
     * @return bool
     */
    private function evaluateRanks(array $uniqueRanks): bool
    {
        $maxRank = max(array_keys($uniqueRanks));
        $minRank = min(array_keys($uniqueRanks));
        $diff = $maxRank - $minRank;
        if ($diff === self::UNIQUERANKS - 1) {
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

        if (count($uniqueSuits) === self::UNIQUESUITS && count($uniqueRanks) === self::UNIQUERANKS) {
            $bool = $this->evaluateRanks($uniqueRanks);
        }
        return $bool;
    }
}
