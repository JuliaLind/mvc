<?php

namespace App\ProjectRules;

trait PointsAndRuleNameTrait2
{
    /**
     * @param array<string> $deck
     * @return array<string,int|string>>
     */
    private function pointsAndNameEmptyHand(array $deck, string $card, int $rulePoints, string $ruleName, RuleStatInterface $rule): array
    {
        if ($rule->check([], $deck, $card)) {
            return [
                'points' => $rulePoints,
                'rule' => $ruleName
            ];
        }
        return [
            // extra point to prioritize empty row/column
            'points' => 1,
            'rule' => ""
        ];
    }
}
