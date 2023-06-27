<?php

namespace App\ProjectRules;

trait EvaluatorTrait4
{
    /**
     * @param array<string> $deck
     * @param array<string> $hand
     * @return array<string,int|string>>
     */
    private function pointsAndName3(array $hand, array $deck, int $rulePoints, string $ruleName, RuleStatInterface $rule): array
    {
        if (count($hand) < 5 && $rule->check2($hand, $deck)) {
            return [
                'points' => $rulePoints,
                'rule' => $ruleName
            ];
        }
        return [
            'points' => 0,
            'rule' => ""
        ];
    }

    /**
     * @param array<string> $deck
     * @return array<string,int|string>>
     */
    private function pointsAndName4(array $deck, int $rulePoints, string $ruleName, RuleStatInterface $rule): array
    {
        if ($rule->check3($deck)) {
            return [
                'points' => $rulePoints,
                'rule' => $ruleName
            ];
        }
        return [
            'points' => 0,
            'rule' => ""
        ];
    }

    /**
     * @param array<string> $deck
     * @param array<array<string>> $hands
     * @param array<string,string|RuleStatInterface|int> $rule
     * @return array<string,string|int>
     */
    public function checkSingleRule2(
        array $hands,
        int $index,
        array $deck,
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
            return $this->pointsAndName3($hands[$index], $deck, $rulePoints, $ruleName, $possible);
        }
        return $this->pointsAndName4($deck, $rulePoints, $ruleName, $possible);
    }

    /**
     * @param array<array<string>> $hands
     * @param array<string> $deck
     * @return array<string,string|int>
     */
    public function checkForRule2(array $hands, int $index, array $deck)
    {
        $data = [
            'points' => 0,
            'rule' => ""
        ];
        $rules = $this->rules;
        $ruleCount = count($rules);
        for ($i = 0; $i < $ruleCount; $i++) {
            $rule = $rules[$i];
            $data = $this->checkSingleRule2($hands, $index, $deck, $rule);
            $handPoints = $data['points'];
            if ($handPoints > 1) {
                break;
            }
        }
        return $data;
    }
}
