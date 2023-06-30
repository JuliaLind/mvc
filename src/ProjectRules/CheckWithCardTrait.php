<?php

namespace App\ProjectRules;

trait CheckWithCardTrait
{
    /**
     * @var array<array<string,string|RuleInterface|RuleStatInterface|int>>
     */
    private array $rules;


    /**
     * @param array<string> $deck
     * @param array<string> $hand
     * @return array<string,float|int|string>>
     */
    abstract private function pointsAndName(array $hand, array $deck, string $card, int $rulePoints, string $ruleName, RuleStatInterface $rule): array;

    /**
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
