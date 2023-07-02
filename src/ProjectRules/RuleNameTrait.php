<?php

namespace App\ProjectRules;

trait RuleNameTrait
{
    /**
     * @param array<string> $deck
     * @param array<string> $hand
     */
    private function ruleName(array $hand, array $deck, string $ruleName, RuleStatInterface $rule): string
    {
        if (count($hand) < 5 && $rule->possibleWithoutCard($hand, $deck)) {
            return $ruleName;
        }
        return "";
    }
}
