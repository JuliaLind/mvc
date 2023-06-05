<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\Card;

/**
 * Royal Flush Rule
 * Ace, King, Queen, Jack, Ten of same suit
 *
 */
class RoyalFlush extends Rule implements RuleInterface
{
    /**
     * @var int $MAXRANK corresponds to Ace
     */
    private const MAXRANK = 14;

    /**
     * @var int $MINRANK corresponds to Ten
     */
    private const MINRANK = 10;

    /**
     * @var int $UNIQUERANKS
     */
    private const UNIQUERANKS = 5;

    /**
     * @var int $UNIQUESUITS
     */
    private const UNIQUESUITS = 1;


    /**
     * @param array<int,int> $uniqueRanks
     * @return bool true if rule is fullfilled otherwise false
     */
    private function evaluateRanks(array $uniqueRanks): bool
    {
        $maxRank = max(array_keys($uniqueRanks));
        $minRank = min(array_keys($uniqueRanks));
        if ($maxRank === self::MAXRANK && $minRank === self::MINRANK) {
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
