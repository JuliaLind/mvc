<?php

namespace App\ProjectEvaluator;

use App\ProjectRules\RuleInterface;

/**
 * For getting the name of the best possible rule that can be scored in
 * a partially filled hand without the dealt card. If the hand is completely filled
 * or no rule is possible without the dealt card, will generate an empty string.
 * From kmom10/Project.
 */
trait RuleNameTrait
{
    /**
     * Returns name of the best possible rule that can be scored in a partially filled hand without the dealt card.
     * If the hand is completely filled an empty string is returned
     * @param array<string> $deck - ranks of the cards from the deck that will be dealt to the player in the remaining game
     * @param array<string> $hand
     */
    private function ruleName(array $hand, array $deck, RuleInterface $rule): string
    {
        if (count($hand) < 5 && $rule->possibleWithoutCard($hand, $deck)) {
            return $rule->getName();
        }
        return "";
    }
}
