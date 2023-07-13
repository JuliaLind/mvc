<?php

namespace App\ProjectEvaluator;

use App\ProjectRules\RuleInterface;

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
     * @return array<string,float|int|string>
     */
    private function pointsAndName(array $hand, array $deck, string $card, RuleInterface $rule): array
    {
        if (count($hand) === 5) {
            return [
                'weight' => -200,
                'rule-with-card' => ""
            ];
        }
        if ($rule->possibleWithCard($hand, $deck, $card)) {
            /**
             * To weight points taking into consideration cards already in hand
             */
            $points = $rule->getPoints() + $rule->getAdditionalValue();
            return [
                'weight' => $points,
                'rule-with-card' => $rule->getName()
            ];
        }
        return [
            'weight' => 0,
            'rule-with-card' => ""
        ];
    }
}
