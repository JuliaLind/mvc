<?php

namespace App\ProjectRules;

trait PointsAndRuleNameTrait
{
    /**
     * Used if a pair or two pairs is possible to score with the
     * dealt card to ensure that placing the card will not destroy any
     * of the better rules that can be possible to achieve without card
     * @param array<string> $hand
     * @param array<string> $deck
     */
    private function betterWithoutCard(array $hand, array $deck): bool
    {
        $rules = array_slice($this->rules, 0, -3);
        foreach ($rules as $rule) {
            if ($rule->possibleWithoutCard($hand, $deck)) {
                return true;
            }
        }
        return false;
    }

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
    private function pointsAndName(array $hand, array $deck, string $card, RuleInterface $rule): array
    {
        if (count($hand) === 5) {
            return [
                'points' => -1,
                'rule' => ""
            ];
        }
        if ($rule->possibleWithCard($hand, $deck, $card)) {
            /**
             * To weight points taking into consideration cards already in hand
             */
            $points = $rule->getPoints() + $rule->getAdditionalValue();
            /**
             * To en sure that aiming for a pair or two
             * pairs will not destroy the chances of getting one
             * of the better rules if there are completely empty rows
             * avalilable (empty rows have a value of 0.5)
             */
            if ($points < 10 && $this->betterWithoutCard($hand, $deck)) {
                $points = 0.3;
            }
            return [
                'points' => $points,
                'rule' => $rule->getName()
            ];
        }
        return [
            'points' => 0,
            'rule' => ""
        ];
    }
}
