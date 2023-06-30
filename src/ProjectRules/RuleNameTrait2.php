<?php

namespace App\ProjectRules;

trait RuleNameTrait2
{
    /**
     * @param array<string> $deck
     */
    private function ruleNameEmptyHand(array $deck, string $ruleName, RuleStatInterface $rule): string
    {
        if ($rule->check3($deck)) {
            return $ruleName;
        }
        return "";
    }
}