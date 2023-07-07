<?php

namespace App\ProjectEvaluator;

use PHPUnit\Framework\TestCase;

class ExtractRuleNamesTraitTest extends TestCase
{
    use ExtractRuleNamesTrait;

    public function testCheckSingleRuleWithNotOk(): void
    {
        $rowData = [
            0 => [
                'rule' => "",
                'points' => 0,
                'rule-without' => "Full House"
            ],
            1 => [
                'rule' => "",
                'points' => 0.5,
                'rule-without' => "Three Of A Kind"
            ],
            2 => [
                'rule' => "Straight",
                'points' => 15,
                'rule-without' => "Three Of A Kind"
            ],
            3 => [
                'rule' => "",
                'points' => 0,
                'rule-without' => "Four Of A Kind"
            ],
            4 => [
                'rule' => "Three Of A Kind",
                'points' => 12,
                'rule-without' => "One Pair"
            ],
        ];
        $colData = [
            0 => [
                'rule' => "",
                'points' => 0,
                'rule-without' => "Two Pairs"
            ],
            1 => [
                'rule' => "",
                'points' => 0.5,
                'rule-without' => "Three Of A Kind"
            ],
            2 => [
                'rule' => "",
                'points' => -1,
                'rule-without' => ""
            ],
            3 => [
                'rule' => "Full House",
                'points' => 0,
                'rule-without' => "Two Pairs"
            ],
            4 => [
                'rule' => "",
                'points' => 0,
                'rule-without' => "Two Pairs"
            ],
        ];
        $exp = [
            "row-rules-with-card" => [
                "",
                "",
                "Straight",
                "",
                "Three Of A Kind"
              ],
              "col-rules-with-card" => [
                "",
                "",
                "",
                "Full House",
                ""
              ],
              "row-rules-without-card" => [
                "Full House",
                "Three Of A Kind",
                "Three Of A Kind",
                "Four Of A Kind",
                "One Pair"
              ],
              "col-rules-without-card" => [
                "Two Pairs",
                "Three Of A Kind",
                "",
                "Two Pairs",
                "Two Pairs"]
              ];
        $res = $this->extractRuleNames($rowData, $colData);
        $this->assertEquals($exp, $res);
    }
}
