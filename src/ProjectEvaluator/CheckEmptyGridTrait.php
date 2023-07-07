<?php

namespace App\ProjectEvaluator;

/**
 * Trait for getting a slot-suggestion for a new/empty grid.
 * Used by the class RuleEvaluator
 */
trait CheckEmptyGridTrait
{
    /**
     * Calculates and returns name and number of points (adjusted/weighted)
     * for the best rule possible to achieve with the dealt card, cards
     * in the hand (row or column) and the cards the user is yet to pickfrom
     * the deck
     * @param array<array<string>> $hands
     * @param array<string> $deck
     * @return array<string,string|int>
     */
    abstract private function handRuleWith(array $hands, int $index, array $deck, string $card);

    /**
     * Used in SuggestionTrait
     *
     * Used for a new/empty array. Always suggests the first empty slot
     * (top-left/ row 0-col 0, and displays which rule will be psosible toachieve
     * at best calculated based on the dealt card and the cards the user is
     * yet to pick from the deck
     * @param array<string> $deck
     * @return array<string,array<int,int|string>|string>
     */
    private function emptyGridSuggestion(array $deck, string $card)
    {
        $data = $this->handRuleWith([0 => []], 0, $deck, $card);
        /**
         * @var string $rule
         */
        $rule = $data['rule'];
        return [
            'col-rule' => $rule,
            'row-rule' => $rule,
            'slot' => [0, 0],
            'row-rules-with-card' => ["$rule", "", "", "", ""],
            'row-rules-without-card' => ["", "", "", "", ""],
            'col-rules-with-card' => ["$rule", "" ,"", "", ""],
            'col-rules-without-card' => ["", "" ,"", "", ""]
        ];
    }
}
