<?php

namespace App\ProjectRules;

trait PointsAndRuleNameTrait2
{
    /**
     * @param array<string> $deck
     * @return array<string,int|string>>
     */
    private function pointsAndNameEmptyHand(array $deck, string $card, RuleInterface $rule): array
    {
        if ($rule->possibleWithCard([], $deck, $card)) {
            return [
                'points' => $rule->getPoints(),
                'rule' => $rule->getName()
            ];
        }
        return [
            // extra point to prioritize empty row/column
            'points' => 1,
            'rule' => ""
        ];
    }
}
