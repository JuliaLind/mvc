<?php

namespace App\ProjectRules;

trait EvaluatorTrait7
{
    /**
     * @param array<string> $deck
     * @return array<string,array<int,int|string>|string>
     */
    protected function emptyGridSuggestion(array $deck, string $card)
    {
        $data = $this->checkForRule([0 => []], 0, $deck, $card);
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
