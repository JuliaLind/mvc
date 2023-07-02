<?php

namespace App\ProjectRules;

trait PointsAndRuleNameTrait
{
    /**
     * If a rule is possible to score returns the name
     * of the rule and the adjusted number of points (
     * for rules Three Of A Kind and up 10% of the 
     * ordinary rule points is added for each card that
     * is already placed in the checked hand to 
     * prioritize a hand that is closer to score, id 
     * there are two hands where same rule is possible 
     * to score
     * 
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
                // some additional points to prioritize the already started rows/cols over empty
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
