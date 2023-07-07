<?php

namespace App\ProjectRules;

/**
 * Used in SuggestionTrait
 */
trait ExtractRuleNamesTrait
{
    /**
     * Takes array with data for all 10 hands
     * (1 array for 5 vertical hands and 1 array for
     * 5 horizontal hands with info about best possible rule
     * to achieve with card and weighted points, and best
     * possible rule to achieve without card. Returns four
     * arrays where each array contains only rule names:
     * array for 5 vertical hands with card,
     * array for 5 vertical hands without card,
     * array for 5 horizontal hands with card,
     * array for 5 horixontal hands without card
     * @param array<int,array<string,float|int|string>> $rowData
     * @param array<int,array<string,float|int|string>> $colData
     * @return array<string,array<int,string>>
     */
    private function extractRuleNames(array $rowData, array $colData): array
    {
        $rowRulesWithCard = [];
        $colRulesWithCard = [];

        $rowRulesWithout = [];
        $colRulesWithout = [];

        for ($i=0; $i <= 4; $i++) {
            /**
             * @var array<string,string|int> $rowDataSingle
             */
            $rowDataSingle = $rowData[$i];
            /**
             * @var string $rowRuleWithCard
             */
            $rowRuleWithCard = $rowDataSingle['rule'];
            $rowRulesWithCard[$i] = $rowRuleWithCard;

            /**
             * @var string $rowRuleWithout
             */
            $rowRuleWithout = $rowDataSingle['rule-without'];
            $rowRulesWithout[$i] = $rowRuleWithout;

            /**
             * @var array<string,string|int> $colDataSingle
             */
            $colDataSingle = $colData[$i];
            /**
             * @var string $colRuleWithCard
             */
            $colRuleWithCard = $colDataSingle['rule'];
            $colRulesWithCard[$i] = $colRuleWithCard;

            /**
             * @var string $colRuleWithout
             */
            $colRuleWithout = $colDataSingle['rule-without'];
            $colRulesWithout[$i] = $colRuleWithout;
        }
        return [
            'row-rules-with-card' => $rowRulesWithCard,
            'col-rules-with-card' => $colRulesWithCard,
            'row-rules-without-card' => $rowRulesWithout,
            'col-rules-without-card' => $colRulesWithout,
        ];
    }
}
