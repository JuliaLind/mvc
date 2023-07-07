<?php

namespace App\ProjectEvaluator;

use PHPUnit\Framework\TestCase;

class CheckEmptyGridTraitTest extends TestCase
{
    use CheckEmptyGridTrait;

    /**
     * @SuppressWarnings(PHPMD.UnusedPrivateMethod)
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * "mock-metod" to remove dependecy
     * @param array<array<string>> $hands
     * @param array<string> $deck
     * @return array<string,string|int>
     */
    private function handRuleWith(array $hands, int $index, array $deck, string $card)
    {
        return [
            'weight' => 47,
            'rule-with-card' => "TestRule"
        ];
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedPrivateMethod)
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * "mock-metod" to remove dependecy
     * @param array<array<string>> $hands
     * @param array<string> $deck
     */
    private function handRuleWithout(array $hands, int $index, array $deck): string
    {
        return "testrule 2";
    }

    public function testAddCard(): void
    {
        // $exp = [
        //     'col-rule' => "TestRule",
        //     'row-rule' => "TestRule",
        //     'slot' => [0, 0],
        //     'row-rules-with-card' => ["TestRule", "", "", "", ""],
        //     'row-rules-without-card' => ["", "", "", "", ""],
        //     'col-rules-with-card' => ["TestRule", "" ,"", "", ""],
        //     'col-rules-without-card' => ["", "" ,"", "", ""]
        // ];

        $exp = [
            'col-rule' => "TestRule",
            'row-rule' => "TestRule",
            'slot' => [0, 0],
            'row-rules' => [
                [
                    'rule-with-card' => "TestRule",
                    'weight' => 47,
                    'rule-without-card' => "testrule 2"
                ],
                [
                    'rule-with-card' => "TestRule",
                    'weight' => 47,
                    'rule-without-card' => "testrule 2"
                ],
                [
                    'rule-with-card' => "TestRule",
                    'weight' => 47,
                    'rule-without-card' => "testrule 2"
                ],
                [
                    'rule-with-card' => "TestRule",
                    'weight' => 47,
                    'rule-without-card' => "testrule 2"
                ],
                [
                    'rule-with-card' => "TestRule",
                    'weight' => 47,
                    'rule-without-card' => "testrule 2"
                ],
            ],
            'col-rules' => [
                [
                    'rule-with-card' => "TestRule",
                    'weight' => 47,
                    'rule-without-card' => "testrule 2"
                ],
                [
                    'rule-with-card' => "TestRule",
                    'weight' => 47,
                    'rule-without-card' => "testrule 2"
                ],
                [
                    'rule-with-card' => "TestRule",
                    'weight' => 47,
                    'rule-without-card' => "testrule 2"
                ],
                [
                    'rule-with-card' => "TestRule",
                    'weight' => 47,
                    'rule-without-card' => "testrule 2"
                ],
                [
                    'rule-with-card' => "TestRule",
                    'weight' => 47,
                    'rule-without-card' => "testrule 2"
                ],
            ]
        ];

        $res = $this->emptyGridSuggestion([], "card");
        $this->assertEquals($exp, $res);
    }

}
