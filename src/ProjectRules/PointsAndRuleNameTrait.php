<?php

namespace App\ProjectRules;

trait PointsAndRuleNameTrait
{
    /**
     * @param array<string> $deck
     * @param array<string> $hand
     * @return array<string,float|int|string>>
     */
    private function pointsAndName(array $hand, array $deck, string $card, int $rulePoints, string $ruleName, RuleStatInterface $rule): array
    {
        if (count($hand) === 5) {
            return [
                'points' => -1,
                'rule' => ""
            ];
        }
        if ($rule->check($hand, $deck, $card)) {
            $points = $rulePoints + 1;
            if ($points >= 10) {
                // some additional points to prioritized the already started rows/cols over empty
                $points += count($hand) * $points * 0.10;
            }
            return [
                'points' => $points,
                'rule' => $ruleName
            ];
        }
        return [
            'points' => 0,
            'rule' => ""
        ];
    }
}
