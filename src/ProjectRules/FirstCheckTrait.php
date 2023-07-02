<?php

namespace App\ProjectRules;

/**
 * Used by the following classes:
 * FlushStat
 * FullHouseStat
 * RoyalFlushStat
 * StraightFlushStat
 * StraightStat
 */
trait FirstCheckTrait
{
    /**
     * 1 point for every card that already is in hand
     * and contributes to the rule
     */
    private int $additionalValue = 0;

    /**
     * @param array<string> $hand
     * @param array<string> $deck
     */
    abstract public function possibleWithoutCard(array $hand, array $deck): bool;

    /**
     * @param array<string> $hand
     * @param array<string> $deck
     */
    public function possibleWithCard(array $hand, array $deck, string $card): bool
    {
        $this->additionalValue = 0;
        /**
         * @var array<string> $newHand
         */
        $newHand = [...$hand, $card];

        if ($this->possibleWithoutCard($newHand, $deck)) {
            $this->additionalValue = count($hand);
            return true;
        }
        return false;
    }

}
