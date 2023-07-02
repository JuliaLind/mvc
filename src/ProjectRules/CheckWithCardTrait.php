<?php

namespace App\ProjectRules;

trait CheckWithCardTrait
{
    /**
     * @var array<array<string,string|RuleInterface|RuleStatInterface|int>>
     */
    private array $rules;


    /**
     * If a rule is possible to score after placing
     * the dealt card into a hand that already
     * contains at least one card, returns the name
     * of the rule and the adjusted number of points (
     * for rules Three Of A Kind and up 10% of the 
     * ordinary rule points is added for each card that
     * is already placed in the checked hand to 
     * prioritize a hand that is closer to score, if 
     * there are two hands where same rule is possible 
     * to score. If the hand is already full returns -1
     * @param array<string> $deck
     * @param array<string> $hand
     * @return array<string,float|int|string>>
     */
    abstract private function pointsAndName(array $hand, array $deck, string $card, int $rulePoints, string $ruleName, RuleStatInterface $rule): array;

    /**
     * If a rule is possible to score after placing
     * the dealt card into a hand that is empty,
     *  returns the name and the points for the rule
     * @param array<string> $deck
     * @return array<string,int|string>>
     */
    abstract private function pointsAndNameEmptyHand(array $deck, string $card, int $rulePoints, string $ruleName, RuleStatInterface $rule): array;

    /**
     * @param array<string> $deck
     * @param array<array<string>> $hands
     * @param array<string,string|RuleInterface|RuleStatInterface|int> $rule
     * @return array<string,string|float|int>
     */
    private function checkSingleRuleWith(
        array $hands,
        int $index,
        array $deck,
        string $card,
        array $rule,
    ): array {
        /**
         * @var string $ruleName
         */
        $ruleName = $rule['name'];
        /**
         * @var int $rulePoints
         */
        $rulePoints = $rule['points'];

        /**
         * @var RuleStatInterface $possible
         */
        $possible = $rule['possible'];
        if (array_key_exists($index, $hands)) {
            return $this->pointsAndName($hands[$index], $deck, $card, $rulePoints, $ruleName, $possible);
        }
        return $this->pointsAndNameEmptyHand($deck, $card, $rulePoints, $ruleName, $possible);
    }

    /**
     * Calculates and returns name and number of points (adjusted/weighted)
     * for the best rule possible to achieve with the dealt card, cards
     * in the hand (row or column) and the cards the user is yet to pick from
     * the deck
     * @param array<array<string>> $hands
     * @param array<string> $deck
     * @return array<string,string|float|int>
     */
    private function handRuleWith(array $hands, int $index, array $deck, string $card)
    {
        $data = [
            'points' => 0,
            'rule' => ""
        ];
        $rules = $this->rules;
        $ruleCount = count($rules);
        for ($i = 0; $i < $ruleCount; $i++) {
            $rule = $rules[$i];
            $data = $this->checkSingleRuleWith($hands, $index, $deck, $card, $rule);
            $handPoints = $data['points'];
            if ($handPoints > 1) {
                break;
            }
        }
        return $data;
    }
}
