<?php

namespace App\Project;

use PHPUnit\Framework\TestCase;

class SuggestMessageTraitTest extends TestCase
{
    use SuggestMessageTrait;

    public function testCreateMessageOk(): void
    {
        $suggestion = [
            'row-rule' => "One Pair",
            'col-rule' => "Two Pairs",
            'slot' => [2, 1],
            'row-rules' => [
                [
                    'rule-with-card' => "",
                    'weight' => -0.25,
                    'rule-without-card' => "Full House"
                ],
                [
                    'rule-with-card' => "",
                    'weight' => -200,
                    'rule-without-card' => ""
                ],
                [
                    'rule-with-card' => "One Pair",
                    'weight' => 2.5,
                    'rule-without-card' => "One Pair"
                ],
                [
                    'rule-with-card' => "",
                    'weight' => -0.1,
                    'rule-without-card' => "Three Of A Kind"
                ],
                [
                    'rule-with-card' => "One Pair",
                    'weight' => 2,
                    'rule-without-card' => "One Pair"
                ],
            ],
            'col-rules' => [
                [
                    'rule-with-card' => "",
                    'weight' => 0,
                    'rule-without-card' => "One Pair"
                ],
                [
                    'rule-with-card' => "Two Pairs",
                    'weight' => 6,
                    'rule-without-card' => "Two Pairs"
                ],
                [
                    'rule-with-card' => "One Pair",
                    'weight' => 2,
                    'rule-without-card' => "One Pair"
                ],
                [
                    'rule-with-card' => "One Pair",
                    'weight' => 2,
                    'rule-without-card' => "One Pair"
                ],
                [
                    'rule-with-card' => "",
                    'weight' => -0.2,
                    'rule-without-card' => "Flush"
                ],
            ],
            'tot-weight-slot' => 2.5 + 6
        ];
        $exp = "Place card in row 2 column 1 for possible One Pair horizontally and/or Two Pairs vertically.";

        $res = $this->createMessage($suggestion);
        $this->assertEquals($exp, $res);
    }

    public function testCreateMessageNotOk(): void
    {
        $suggestion = [
            'row-rule' => "",
            'col-rule' => "",
            'slot' => [2, 2],
            'row-rules' => [
                [
                    'rule-with-card' => "",
                    'weight' => 0,
                    'rule-without-card' => ""
                ],
                [
                    'rule-with-card' => "",
                    'weight' => 0,
                    'rule-without-card' => ""
                ],
                [
                    'rule-with-card' => "",
                    'weight' => 0,
                    'rule-without-card' => ""
                ],
                [
                    'rule-with-card' => "",
                    'weight' => 0,
                    'rule-without-card' => ""
                ],
                [
                    'rule-with-card' => "",
                    'weight' => 0,
                    'rule-without-card' => ""
                ],
            ],
            'col-rules' => [
                [
                    'rule-with-card' => "",
                    'weight' => 0,
                    'rule-without-card' => ""
                ],
                [
                    'rule-with-card' => "",
                    'weight' => 0,
                    'rule-without-card' => ""
                ],
                [
                    'rule-with-card' => "",
                    'weight' => 0,
                    'rule-without-card' => ""
                ],
                [
                    'rule-with-card' => "",
                    'weight' => 0,
                    'rule-without-card' => ""
                ],
                [
                    'rule-with-card' => "",
                    'weight' => 0,
                    'rule-without-card' => ""
                ],
            ],
        ];
        $exp = "";

        $res = $this->createMessage($suggestion);
        $this->assertEquals($exp, $res);
    }

    public function testCreateMessageOk2(): void
    {
        $suggestion = [
            'row-rule' => "",
            'col-rule' => "Full House",
            'slot' => [1, 0],
            'row-rules' => [
                [
                    'rule-with-card' => "",
                    'weight' => 0,
                    'rule-without-card' => "One Pair"
                ],
                [
                    'rule-with-card' => "",
                    'weight' => 0,
                    'rule-without-card' => "Two Pairs"
                ],
                [
                    'rule-with-card' => "",
                    'weight' => 0,
                    'rule-without-card' => "One Pair"
                ],
                [
                    'rule-with-card' => "One Pair",
                    'weight' => 3,
                    'rule-without-card' => "One Pair"
                ],
                [
                    'rule-with-card' => "One Pair",
                    'weight' => -0.2,
                    'rule-without-card' => "Flush"
                ],
            ],
            'col-rules' => [
                [
                    'rule-with-card' => "Full House",
                    'weight' => 29,
                    'rule-without-card' => "Two Pairs"
                ],
                [
                    'rule-with-card' => "",
                    'weight' => -200,
                    'rule-without-card' => ""
                ],
                [
                    'rule-with-card' => "",
                    'weight' => 0.5,
                    'rule-without-card' => "One Pair"
                ],
                [
                    'rule-with-card' => "",
                    'weight' => -0.1,
                    'rule-without-card' => "Three Of A Kind"
                ],
                [
                    'rule-with-card' => "",
                    'weight' => 0,
                    'rule-without-card' => "One Pair"
                ],
            ],

            'tot-weight-slot' => 29 + 0
        ];
        $exp = "Place card in row 1 column 0 for possible Full House vertically.";

        $res = $this->createMessage($suggestion);
        $this->assertEquals($exp, $res);
    }

    public function testCreateMessageOk3(): void
    {
        $suggestion = [
            'row-rule' => "Full House",
            'col-rule' => "",
            'slot' => [0, 1],
            'row-rules' => [
                [
                    'rule-with-card' => "Full House",
                    'weight' => 29,
                    'rule-without-card' => "Two Pairs"
                ],
                [
                    'rule-with-card' => "",
                    'weight' => -200,
                    'rule-without-card' => ""
                ],
                [
                    'rule-with-card' => "",
                    'weight' => 0.5,
                    'rule-without-card' => "One Pair"
                ],
                [
                    'rule-with-card' => "",
                    'weight' => -0.1,
                    'rule-without-card' => "Three Of A Kind"
                ],
                [
                    'rule-with-card' => "",
                    'weight' => 0,
                    'rule-without-card' => "One Pair"
                ],
            ],
            'col-rules' => [
                [
                    'rule-with-card' => "",
                    'weight' => 0,
                    'rule-without-card' => "One Pair"
                ],
                [
                    'rule-with-card' => "",
                    'weight' => 0,
                    'rule-without-card' => "Two Pairs"
                ],
                [
                    'rule-with-card' => "",
                    'weight' => 0,
                    'rule-without-card' => "One Pair"
                ],
                [
                    'rule-with-card' => "One Pair",
                    'weight' => 3,
                    'rule-without-card' => "One Pair"
                ],
                [
                    'rule-with-card' => "One Pair",
                    'weight' => -0.2,
                    'rule-without-card' => "Flush"
                ],
            ],
            'tot-weight-slot' => 29 + 0
        ];
        $exp = "Place card in row 0 column 1 for possible Full House horizontally.";

        $res = $this->createMessage($suggestion);
        $this->assertEquals($exp, $res);
    }
}
