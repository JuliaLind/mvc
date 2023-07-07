<?php

namespace App\ProjectEvaluator;

use App\ProjectRules\RuleInterface;

trait RuleNameTrait
{
    /**
     * @param array<string> $deck
     * @param array<string> $hand
     */
    private function ruleName(array $hand, array $deck, RuleInterface $rule): string
    {
        if (count($hand) < 5 && $rule->possibleWithoutCard($hand, $deck)) {
            return $rule->getName();
        }
        return "";
    }
}
