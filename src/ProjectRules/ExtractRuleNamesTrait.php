<?php

namespace App\ProjectRules;

trait ExtractRuleNamesTrait
{
    /**
     * @param array<int,array<string,int|string>> $rowData
     * @param array<int,array<string,int|string>> $colData
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
