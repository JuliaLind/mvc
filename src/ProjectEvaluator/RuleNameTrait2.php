<?php

namespace App\ProjectEvaluator;

use App\ProjectRules\RuleInterface;

/**
 * For getting the name of the best possible rule that can be scored in
 * an empty hand without the dealt card. If the hand is completely filled
 * or no rule is possible without the dealt card, will generate an empty string.
 * From kmom10/Project.
 */
trait RuleNameTrait2
{
    /**
     * Returns name of the best possible rule that can be scored in an empty hand without the dealt card
     * @param array<string> $deck - ranks of the cards from the deck that will be dealt to the player in the remaining game
     */
    private function ruleNameEmptyHand(array $deck, RuleInterface $rule): string
    {
        if ($rule->possibleDeckOnly($deck)) {
            return $rule->getName();
        }
        return "";
    }
}
