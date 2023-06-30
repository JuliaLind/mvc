<?php

namespace App\ProjectRules;

trait CheckWithoutCardTrait
{
    /**
     * @param array<string> $deck
     * @param array<string> $hand
     */
    abstract private function ruleName(array $hand, array $deck, string $ruleName, RuleStatInterface $rule): string;

    /**
     * @param array<string> $deck
     */
    abstract private function ruleNameEmptyHand(array $deck, string $ruleName, RuleStatInterface $rule): string;

    /**
     * @param array<string> $deck
     * @param array<array<string>> $hands
     * @param array<string,string|RuleInterface|RuleStatInterface|int> $rule
     */
    private function checkSingleRuleWithout(
        array $hands,
        int $index,
        array $deck,
        array $rule,
    ): string {
        /**
         * @var string $ruleName
         */
        $ruleName = $rule['name'];
        /**
         * @var RuleStatInterface $possible
         */
        $possible = $rule['possible'];
        if (array_key_exists($index, $hands)) {
            return $this->ruleName($hands[$index], $deck, $ruleName, $possible);
        }
        return $this->ruleNameEmptyHand($deck, $ruleName, $possible);
    }

    /**
     * @param array<array<string>> $hands
     * @param array<string> $deck
     */
    private function handRuleWithout(array $hands, int $index, array $deck): string
    {
        $ruleName = "";
        $rules = $this->rules;
        $ruleCount = count($rules);
        for ($i = 0; $i < $ruleCount; $i++) {
            $rule = $rules[$i];
            $ruleName = $this->checkSingleRuleWithout($hands, $index, $deck, $rule);
            if ($ruleName != "") {
                break;
            }
        }
        return $ruleName;
    }
}
