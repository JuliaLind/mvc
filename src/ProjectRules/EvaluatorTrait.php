<?php

namespace App\ProjectRules;

trait EvaluatorTrait
{
    /**
     * @var array<array<string,string|RuleStatInterface|int>>
     */
    private array $rules;


    /**
     * @param array<string> $deck
     * @param array<string> $hand
     * @return array<string,float|int|string>>
     */
    private function pointsAndName1(array $hand, array $deck, string $card, int $rulePoints, string $ruleName, RuleStatInterface $rule): array
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

    /**
     * @param array<string> $deck
     * @return array<string,int|string>>
     */
    private function pointsAndName2(array $deck, string $card, int $rulePoints, string $ruleName, RuleStatInterface $rule): array
    {
        if ($rule->check([], $deck, $card)) {
            return [
                'points' => $rulePoints,
                'rule' => $ruleName
            ];
        }
        return [
            // extra point to prioritize empty row/column
            'points' => 1,
            'rule' => ""
        ];
    }
    /**
     * @param array<string> $deck
     * @param array<array<string>> $hands
     * @param array<string,string|RuleStatInterface|int> $rule
     * @return array<string,string|float|int>
     */
    public function checkSingleRule(
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
            return $this->pointsAndName1($hands[$index], $deck, $card, $rulePoints, $ruleName, $possible);
        }
        return $this->pointsAndName2($deck, $card, $rulePoints, $ruleName, $possible);
    }

    /**
     * @param array<array<string>> $hands
     * @param array<string> $deck
     * @return array<string,string|float|int>
     */
    public function checkForRule(array $hands, int $index, array $deck, string $card)
    {
        $data = [
            'points' => 0,
            'rule' => ""
        ];
        $rules = $this->rules;
        $ruleCount = count($rules);
        for ($i = 0; $i < $ruleCount; $i++) {
            $rule = $rules[$i];
            $data = $this->checkSingleRule($hands, $index, $deck, $card, $rule);
            $handPoints = $data['points'];
            if ($handPoints > 1) {
                break;
            }
        }
        return $data;
    }
}
