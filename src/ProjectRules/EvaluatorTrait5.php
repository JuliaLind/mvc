<?php

namespace App\ProjectRules;

trait EvaluatorTrait5
{
    /**
     * @param array<int,array<string,int|string>> $rowDataWithCard
     * @param array<int,array<string,int|string>> $rowDataWithoutCard
     * @param array<int,array<string,int|string>> $colDataWithCard
     * @param array<int,array<string,int|string>> $colDataWithoutCard
     * @return array<string,array<int,string>>
     */
    public function extractRuleNames(array $rowDataWithCard, array $colDataWithCard, array $rowDataWithoutCard, array $colDataWithoutCard): array
    {
        $rowRulesWithCard = [];
        $colRulesWithCard = [];
        $rowRulesWithoutCard = [];
        $colRulesWithoutCard = [];
        for ($i=0; $i <= 4; $i++) {
            /**
             * @var array<string,string|int> $rowData1
             */
            $rowData1 = $rowDataWithCard[$i];
            /**
             * @var string $rowRuleWithCard
             */
            $rowRuleWithCard = $rowData1['rule'];
            $rowRulesWithCard[$i] = $rowRuleWithCard;
            /**
             * @var array<string,string|int> $rowData2
             */
            $rowData2 = $rowDataWithoutCard[$i];
            /**
             * @var string $rowRuleWithoutCard
             */
            $rowRuleWithoutCard = $rowData2['rule'];
            $rowRulesWithoutCard[$i] = $rowRuleWithoutCard;

            /**
             * @var array<string,string|int> $colData1
             */
            $colData1 = $colDataWithCard[$i];
            /**
             * @var string $colRuleWithCard
             */
            $colRuleWithCard = $colData1['rule'];
            $colRulesWithCard[$i] = $colRuleWithCard;
            /**
             * @var array<string,string|int> $colData2
             */
            $colData2 = $colDataWithoutCard[$i];
            /**
             * @var string $colRuleWithoutCard
             */
            $colRuleWithoutCard = $colData2['rule'];
            $colRulesWithoutCard[$i] = $colRuleWithoutCard;
        }
        return [
            'row-rules-with-card' => $rowRulesWithCard,
            'row-rules-without-card' => $rowRulesWithoutCard,
            'col-rules-with-card' => $colRulesWithCard,
            'col-rules-without-card' => $colRulesWithoutCard
        ];
    }
}
