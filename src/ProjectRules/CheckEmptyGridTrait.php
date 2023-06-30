<?php

namespace App\ProjectRules;

trait CheckEmptyGridTrait
{
    /**
     * @param array<array<string>> $hands
     * @param array<string> $deck
     * @return array<string,string|int>
     */
    abstract private function handRuleWith(array $hands, int $index, array $deck, string $card);

    /**
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
