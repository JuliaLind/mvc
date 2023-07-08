<?php

namespace App\ProjectEvaluator;

use PHPUnit\Framework\TestCase;

class SlotTraitTest extends TestCase
{
    use SlotTrait;
    use EmptyCellsTrait;


    public function testBestSlot(): void
    {

        $pointsRows = [
            [
                "rule-with-card" => "Full House",
                "weight" => 25.5,
                "rule-without-card" => "Full House"
            ],
            [
                "rule-with-card" => "Two Pairs",
                "weight" => 6,
                "rule-without-card" => "One Pair"
            ],
            [
                "rule-with-card" => "One Pair",
                "weight" => -0.1,
                "rule-without-card" => "Three Of A Kind"
            ],
            [
                "rule-with-card" => "Flush",
                "weight" => 22,
                "rule-without-card" => "Full House"
            ],
            [
                "rule-with-card" => "Two Pairs",
                "weight" => -0.15,
                "rule-without-card" => "Straight"
            ]
        ];
        $pointsCols = [
            [
                "rule-with-card" => "Two Pairs",
                "weight" => -0.1,
                "rule-without-card" => "Three Of A Kind"
            ],
            [
            "rule-with-card" => "Two Pairs",
            "weight" => -0.25,
            "rule-without-card" => "Full House"
            ],
            [
            "rule-with-card" => "Straight",
            "weight" => 17,
            "rule-without-card" => "Straight"
            ],
            [
            "rule-with-card" => "Straight",
            "weight" => 17,
            "rule-without-card" => "Straight"
            ],
            [
            "rule-with-card" => "Two Pairs",
            "weight" => -0.2,
            "rule-without-card" => "Flush"
            ]
        ];
        $rows = [
            1 => [
                0 => "12H",
                1 => "9H",
                2 => "8C"
            ],
            2 => [
                0 => "10H",
                2 => "5H"
            ],
            3 => [
                1 => "14C",
                3 => "6C"
            ],
            4 => [
                0 => "3D",
                3 => "5S",
                4 => "2S"
            ]
        ];
        $bestRow = 0;
        $bool = false;
        $exp = [
            'col-rule' => "Straight",
            'row-rule' => "Full House",
            'slot' => [0, 3],
            'tot-weight-slot' => 25.5 + 17
        ];
        $res = $this->bestSlot($pointsRows, $pointsCols, $bestRow, $rows, $bool);
        $this->assertEquals($exp, $res);
    }

    public function testBestSlotInverted(): void
    {

        $pointsRows = [
            [
                "rule-with-card" => "Full House",
                "weight" => 25.5,
                "rule-without-card" => "Full House"
            ],
            [
                "rule-with-card" => "Two Pairs",
                "weight" => 6,
                "rule-without-card" => "One Pair"
            ],
            [
                "rule-with-card" => "One Pair",
                "weight" => -0.1,
                "rule-without-card" => "Three Of A Kind"
            ],
            [
                "rule-with-card" => "Flush",
                "weight" => 22,
                "rule-without-card" => "Full House"
            ],
            [
                "rule-with-card" => "Two Pairs",
                "weight" => -0.15,
                "rule-without-card" => "Straight"
            ]
        ];
        $pointsCols = [
            [
                "rule-with-card" => "Two Pairs",
                "weight" => -0.1,
                "rule-without-card" => "Three Of A Kind"
            ],
            [
            "rule-with-card" => "Two Pairs",
            "weight" => -0.25,
            "rule-without-card" => "Full House"
            ],
            [
            "rule-with-card" => "Straight",
            "weight" => 17,
            "rule-without-card" => "Straight"
            ],
            [
            "rule-with-card" => "Straight",
            "weight" => 17,
            "rule-without-card" => "Straight"
            ],
            [
            "rule-with-card" => "Two Pairs",
            "weight" => -0.2,
            "rule-without-card" => "Flush"
            ]
        ];
        $rows = [
            1 => [
                0 => "12H",
                1 => "9H",
                2 => "8C"
            ],
            2 => [
                0 => "10H",
                2 => "5H"
            ],
            3 => [
                1 => "14C",
                3 => "6C"
            ],
            4 => [
                0 => "3D",
                3 => "5S",
                4 => "2S"
            ]
        ];
        $bestRow = 0;
        $bool = true;
        $exp = [
            'col-rule' => "Full House",
            'row-rule' => "Straight",
            'slot' => [3, 0],
            'tot-weight-slot' => 25.5 + 17
        ];
        $res = $this->bestSlot($pointsRows, $pointsCols, $bestRow, $rows, $bool);
        $this->assertEquals($exp, $res);
    }

    public function testBestSlot2(): void
    {

        $pointsRows = [
            [
                "rule-with-card" => "Full House",
                "weight" => 25.5,
                "rule-without-card" => "Full House"
            ],
            [
                "rule-with-card" => "Two Pairs",
                "weight" => 6,
                "rule-without-card" => "One Pair"
            ],
            [
                "rule-with-card" => "One Pair",
                "weight" => -0.1,
                "rule-without-card" => "Three Of A Kind"
            ],
            [
                "rule-with-card" => "Flush",
                "weight" => 22,
                "rule-without-card" => "Full House"
            ],
            [
                "rule-with-card" => "Two Pairs",
                "weight" => -0.15,
                "rule-without-card" => "Straight"
            ]
        ];
        $pointsCols = [
            [
                "rule-with-card" => "Two Pairs",
                "weight" => -0.1,
                "rule-without-card" => "Three Of A Kind"
            ],
            [
            "rule-with-card" => "Two Pairs",
            "weight" => -0.25,
            "rule-without-card" => "Full House"
            ],
            [
            "rule-with-card" => "Straight",
            "weight" => 17,
            "rule-without-card" => "Straight"
            ],
            [
            "rule-with-card" => "Straight",
            "weight" => 17,
            "rule-without-card" => "Straight"
            ],
            [
            "rule-with-card" => "Two Pairs",
            "weight" => -0.2,
            "rule-without-card" => "Flush"
            ]
        ];
        $rows = [
            0 => [
                4 => "8C"
            ],
            1 => [
                0 => "12H",
                1 => "9H",
            ],
            2 => [
                0 => "10H",
                2 => "5H"
            ],
            3 => [
                1 => "14C",
                3 => "6C"
            ],
            4 => [
                0 => "3D",
                3 => "5S",
                4 => "2S"
            ]
        ];
        $bestRow = 0;
        $bool = false;
        $exp = [
            'col-rule' => "Straight",
            'row-rule' => "Full House",
            'slot' => [0, 3],
            'tot-weight-slot' => 25.5 + 17
        ];
        $res = $this->bestSlot($pointsRows, $pointsCols, $bestRow, $rows, $bool);
        $this->assertEquals($exp, $res);
    }
}
