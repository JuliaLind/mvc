<?php

namespace App\ProjectEvaluator;

use App\ProjectRules\RuleInterface;

/**
 * Checks a hand for the best possible rule that can be
 * achieved without the dealt card, from kmom10/Project
 */
trait CheckWithoutCardTrait
{
    use RuleNameTrait;
    use RuleNameTrait2;

    /**
     * @var array<RuleInterface> $rules
     */
    private array $rules;


    /**
     * Checks one hand for a single rule. Returns true if the rule can
     * be achieved in the hand without the dealt card
     * @param array<string> $deck - the remaining cards to be dealt to the player from the deck
     * @param array<array<string>> $hands
     */
    private function checkSingleRuleWithout(
        array $hands,
        int $index,
        array $deck,
        RuleInterface $rule,
    ): string {
        if (array_key_exists($index, $hands)) {
            return $this->ruleName($hands[$index], $deck, $rule);
        }
        return $this->ruleNameEmptyHand($deck, $rule);
    }

    /**
     * Used in:
     * RulesWithoutCardTrait,
     * CheckEmptyGridTrait
     *
     * Checks one hand for the highest possible rule that can be scored
     * without the dealt card
     * @param array<array<string>> $hands
     * @param array<string> $deck - the remaining cards to be dealt to the player from the deck
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    private function handRuleWithout(array $hands, int $index, array $deck): string
    {
        $ruleName = "";
        $rules = $this->rules;
        foreach ($rules as $rule) {
            $ruleName = $this->checkSingleRuleWithout($hands, $index, $deck, $rule);
            if ($ruleName != "") {
                break;
            }
        }
        return $ruleName;
    }
}
