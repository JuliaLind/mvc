<?php

namespace App\ProjectRules;

trait ExtractRuleNamesTrait
{
    /**
     * @param array<int,array<string,int|string>> $rowDataWithCard
     * @param array<int,array<string,int|string>> $colDataWithCard
     * @return array<string,array<int,string>>
     */
    private function extractRuleNames(array $rowDataWithCard, array $colDataWithCard): array
    {
        $rowRulesWithCard = [];
        $colRulesWithCard = [];
        for ($i=0; $i <= 4; $i++) {
            /*
             * @var array<string,string|int> $rowData
             */
            $rowData = $rowDataWithCard[$i];
            /**
             * @var string $rowRuleWithCard
             */
            $rowRuleWithCard = $rowData['rule'];
            $rowRulesWithCard[$i] = $rowRuleWithCard;

            /**
             * @var array<string,string|int> $colData
             */
            $colData = $colDataWithCard[$i];
            /**
             * @var string $colRuleWithCard
             */
            $colRuleWithCard = $colData['rule'];
            $colRulesWithCard[$i] = $colRuleWithCard;
        }
        return [
            'row-rules-with-card' => $rowRulesWithCard,
            'col-rules-with-card' => $colRulesWithCard,
        ];
    }
}
