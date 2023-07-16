<?php

namespace App\ProjectEvaluator;

use App\ProjectRules\RuleInterface;

/**
 * Trait for getting the nmae of the best possible rule that can be scored in an empty hand, with the dealt card,
 * and the weight of the hand, from kmom10/Project
 */
trait PointsAndRuleNameTrait2
{
    /**
     * @param array<string> $deck - the cards from the deck that will be dealt to the player in the remaining game
     * @return array<string,float|int|string>
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
