<?php

namespace App\ProjectEvaluator;

use App\ProjectRules\RuleInterface;

trait PointsAndRuleNameTrait2
{
    /**
     * @param array<string> $deck
     * @return array<string,float|int|string>>
     */
    private function pointsAndNameEmptyHand(array $deck, string $card, RuleInterface $rule): array
    {
        /**
         * extra point to prioritize empty row/column
         * if rule is not possible to score
         */
        $points = 0.5;
        if ($rule->possibleWithCard([], $deck, $card)) {
            $points += $rule->getPoints();
            return [
                'weight' => $points,
                'rule-with-card' => $rule->getName()
            ];
        }
        return [
            'weight' => $points,
            'rule-with-card' => ""
        ];
    }
}
