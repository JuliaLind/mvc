<?php

namespace App\ProjectEvaluator;

use App\ProjectRules\RuleInterface;

trait RuleNameTrait2
{
    /**
     * @param array<string> $deck
     */
    private function ruleNameEmptyHand(array $deck, RuleInterface $rule): string
    {
        if ($rule->possibleDeckOnly($deck)) {
            return $rule->getName();
        }
        return "";
    }
}
