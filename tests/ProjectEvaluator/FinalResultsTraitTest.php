<?php

namespace App\ProjectEvaluator;

use App\ProjectRules\RoyalFlush;
use App\ProjectRules\StraightFlush;
use App\ProjectRules\SameOfAKind;
use App\ProjectRules\FullHouse;
use App\ProjectRules\Flush;
use App\ProjectRules\Straight;
use App\ProjectRules\TwoPairs;


use App\ProjectGrid\Grid;
use PHPUnit\Framework\TestCase;

class FinalResultsTraitTest extends TestCase
{
    use FinalResultsTrait;
    use RowsToColsTrait;

    protected function setUp(): void
    {
        $this->rules = [
            new RoyalFlush(),
            new StraightFlush(),
            new SameOfAKind(4),
            new FullHouse(),
            new Flush(),
            new Straight(),
            new SameOfAKind(3),
            new TwoPairs(),
            new SameOfAKind(2)
        ];
    }

    public function testResultsOneDirection(): void
    {
        $hands = [
            0 => [
                0 => "8H",
                1 => "7H",
                2 => "6H",
                3 => "5H",
                4 => "9H"
            ],
            1 => [
                0 => "9S",
                1 => "6D",
                2 => "6S",
                3 => "3D",
                4 => "7D"
            ],
            2 => [
                0 => "11D",
                1 => "9D",
                2 => "5D",
                3 => "4S",
                4 => "7C"
            ],
            3 => [
                0 => "2D",
                1 => "5C",
                2 => "2C",
                3 => "2S",
                4 => "2H"
            ],
            4 => [
                0 => "13C",
                1 => "14S",
                2 => "10H",
                3 => "11C",
                4 => "12H"
            ]
        ];
        $res = $this->resultsOneDirection($hands);
        $total = 75 + 2 + 50 + 15;
        $exp = [
            'data' => [
                0 => [
                    "name" => "Straight Flush",
                    "points" => 75
                  ],
                  1 => [
                    "name" => "One Pair",
                    "points" => 2
                  ],
                  2 => [
                    "name" => "None",
                    "points" => 0
                  ],
                  3 => [
                    "name" => "Four Of A Kind",
                    "points" => 50
                  ],
                  4 => [
                    "name" => "Straight",
                    "points" => 15
                  ]
            ],
            'total' => $total
        ];
        $this->assertEquals($exp, $res);
    }

    public function testResults(): void
    {
        $grid = $this->createMock(Grid::class);

        $rows = [
            [ "8H",  "7H",  "6H",  "5H",  "9H"],
            [ "9S",  "6D",  "6S",  "3D",  "7D"],
            ["11D",  "9D",  "5D",  "4S",  "7C"],
            [ "2D",  "5C",  "2C",  "2S",  "2H"],
            ["13C", "14S", "10H", "11C", "12H"]
        ];
        $grid->method('getRows')->willReturn($rows);

        $total = 75 + 2 + 50 + 15 + 2 + 2;
        $exp = [
            "rows" => [
                0 => [
                  "name" => "Straight Flush",
                  "points" => 75
                ],
                1 => [
                  "name" => "One Pair",
                  "points" => 2
                ],
                2 => [
                  "name" => "None",
                  "points" => 0
                ],
                3 => [
                  "name" => "Four Of A Kind",
                  "points" => 50
                ],
                4 => [
                  "name" => "Straight",
                  "points" => 15
                ]
              ],
            "cols" => [
                0 => [
                  "name" => "None",
                  "points" => 0
                ],
                1 => [
                  "name" => "None",
                  "points" => 0
                ],
                2 => [
                  "name" => "One Pair",
                  "points" => 2
                ],
                3 => [
                  "name" => "None",
                  "points" => 0
                ],
                4 => [
                  "name" => "One Pair",
                  "points" => 2
                ]
            ],
            "total" => $total
        ];
        $res = $this->results($grid);
        $this->assertEquals($exp, $res);
    }
}
