<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

use App\ProjectGrid\Grid;

class WinEvaluatorTest extends TestCase
{
    public function testCheckForWin(): void
    {
        $evaluator = new WinEvaluator();

        $rows = [
                    ["14D", "14C", "14S", "5C", "10H"],
                    ["10D", "8C", "8D", "5D", "6H"],
                    ["12D", "3C", "2C", "5S", "7H"],
                    ["13D", "4C", "9C", "5H", "8H"],
                    ["11D", "7C", "10H", "8S", "9H"]
        ];

        $exp = [
            'rows' => [
                0 => [
                    'name' => 'Three Of A Kind',
                    'points' => 10
                ],
                1 => [
                    'name' => 'One Pair',
                    'points' => 2
                ],
                2 => [
                    'name' => 'None',
                    'points' => 0
                ],
                3 => [
                    'name' => 'None',
                    'points' => 0
                ],
                4 => [
                    'name' => 'Straight',
                    'points' => 15
                ],
            ],
            'cols' => [
                0 => [
                    'name' => 'Royal Flush',
                    'points' => 100
                ],
                1 => [
                    'name' => 'Flush',
                    'points' => 20
                ],
                2 => [
                    'name' => 'None',
                    'points' => 0
                ],
                3 => [
                    'name' => 'Four Of A Kind',
                    'points' => 50
                ],
                4 => [
                    'name' => 'Straight Flush',
                    'points' => 75
                ],
            ],
            'total' => (10+2+15+100+20+50+75)
        ];

        $res = $evaluator->results($rows);

        $this->assertEquals($exp, $res);
    }

    public function testCheckForWin2(): void
    {
        $evaluator = new WinEvaluator();

        $rows = [
            ["3C","3S","5C","3D","5D"],
            ["9C", "10S", "9H", "5H", "7H"],
            ["8C","14H","6C","6H","4D"],
            ["11C","13D","12H","2H","8H"],
            ["10C","13S","11S","4S","2S"]
        ];

        $exp = [
            "rows" => [
                0 => [
                    "name" => "Full House",
                    "points" => 25
                ],
                4 => [
                    "name" => "None",
                    "points"=> 0
                ],
                3 => [
                    "name" => "None",
                    "points" => 0
                ],
                2 => [
                    "name" => "One Pair",
                    "points" => 2
                ],
                1 => [
                    "name" => "One Pair",
                    "points" => 2
                ]
            ],
            "cols" => [
                0 => [
                    "name" => "Flush",
                    "points" => 20
                ],
                4 => [
                    "name" => "None",
                    "points" => 0
                ],
                3 => [
                    "name" => "Straight",
                    "points" => 15
                ],
                2 => [
                    "name" => "None",
                    "points" => 0
                ],
                1 => [
                    "name" => "One Pair",
                    "points" => 2
                ]
            ],
            "total" => 66
        ];

        $res = $evaluator->results($rows);

        $this->assertEquals($exp, $res);
    }

    public function testCheckForWin3(): void
    {
        $evaluator = new WinEvaluator();

        $rows = [
            ["6S","6D","11H","13C","11D"],
            ["10H","7D","12D","12C","12S"],
            ["2D","9S","2C","9D","5S"],
            ["8D","8S","14C","14S","10D"],
            ["4C","7C","4H","13H","7S"]
        ];

        $exp = [
            "rows" => [
                0 => [
                    "name" => "Two Pairs",
                    "points" => 5
                ],
                4 => [
                    "name" => "Two Pairs",
                    "points" => 5
                ],
                3 => [
                    "name" => "Two Pairs",
                    "points" => 5
                ],
                2 => [
                    "name" => "Two Pairs",
                    "points" => 5
                ],
                1 => [
                    "name" => "Three Of A Kind",
                    "points" => 10
                ]
            ],
            "cols" => [
                0 => [
                    "name" => "None",
                    "points" => 0
                ],
                4 => [
                    "name" => "None",
                    "points" => 0
                ],
                3 => [
                    "name" => "One Pair",
                    "points" => 2
                ],
                2 => [
                    "name" => "None",
                    "points" => 0
                ],
                1 => [
                    "name" => "One Pair",
                    "points" => 2
                ]
            ],
            "total" => 34
        ];

        $res = $evaluator->results($rows);

        $this->assertEquals($exp, $res);
    }
}
