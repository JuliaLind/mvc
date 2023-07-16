<?php

namespace App\ProjectEvaluator;

/**
 * Trait for getting a slot-suggestion for a new/empty grid.
 * Used by the class RuleEvaluator, from kmom10/Project
 */
trait CheckEmptyGridTrait
{
    /**
     * Calculates and returns name and number of points (adjusted/weighted)
     * for the best rule possible to achieve with the dealt card, cards
     * in the hand (row or column) and the cards the user is yet to pickfrom
     * the deck
     * @param array<array<string>> $hands
     * @param array<string> $deck - the remaining cards to be dealt to the player from the deck
     * @return array<string,string|int>
     */
    abstract private function handRuleWith(array $hands, int $index, array $deck, string $card);

    /**
     * Used in:
     * RulesWithoutCardTrait,
     * CheckEmptyGridTrait
     *
     * Checks one hand for the highest possible rule that can be scored
     * without the dealt card
     * @param array<array<string>> $hands
     * @param array<string> $deck - the remaining cards to be dealt to the player from the deck
     */
    abstract private function handRuleWithout(array $hands, int $index, array $deck): string;

    /**
     * Used in SuggestionTrait
     *
     * Used for a new/empty array. Always suggests the first empty slot
     * (top-left/ row 0-col 0, and displays which rule will be psosible toachieve
     * at best calculated based on the dealt card and the cards the user is
     * yet to pick from the deck
     * @param array<string> $deck - the remaining cards to be dealt to the player from the deck
     * @return array<string,array<int,array<string,float|int|string>|int>|string>
     */
    private function emptyGridSuggestion(array $deck, string $card)
    {
        $data = $this->handRuleWith([0 => []], 0, $deck, $card);
        $ruleWithout = $this->handRuleWithout([], 0, $deck);
        /**
         * @var string $rule
         */
        $rule = $data['rule-with-card'];
        $data2 = [
            'col-rule' => $rule,
            'row-rule' => $rule,
            'slot' => [0, 0],
            'row-rules' => [],
            'col-rules' => []
        ];

        for ($i = 0; $i <= 4; $i++) {
            $dummyData = [
                'rule-with-card' => $rule,
                'weight' => $data['weight'],
                'rule-without-card' => $ruleWithout
            ];
            $data2['row-rules'][] = $dummyData;
            $data2['col-rules'][] = $dummyData;
        }
        return $data2;
    }
}
