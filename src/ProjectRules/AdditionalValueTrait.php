<?php

namespace App\ProjectRules;

/**
 * Used by classes that implement the RuleStat interface.
 * Used to weight the value of a hand where a rule is possible
 * to score taking into consideration the number of
 * cards that already are placed in the hand and contribute to the rule,
 * in order to determine suggested slot.
 * From kmom10/Project
 */
trait AdditionalValueTrait
{
    /**
     * 1 point for every card that already is in hand
     * and contributes to the rule. This attribute is changed in the check() method of each class
     */
    private int $additionalValue = 0;

    public function getAdditionalValue(): int
    {
        return $this->additionalValue;
    }
}
