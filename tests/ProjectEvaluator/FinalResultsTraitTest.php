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

    public function testResults2(): void
    {
        $grid = $this->createMock(Grid::class);

        $rows = [
            ["8C","8H","11C","12S","12C"],
            ["10S","4C","11S","10D","10C"],
            ["9S","13D","11H","13H","7C"],
            ["14S","2D","2S","9D","3C"],
            ["13C","3H","2C","13S","6C"]
        ];
        $grid->method('getRows')->willReturn($rows);

        $total = 5 + 10 + 2 + 2 + 2 + 25 + 2 + 20;
        $exp = [
            "rows" => [
                0 => [
                    "name" => "Two Pairs",
                    "points" => 5
                ],
                1 => [
                    "name" => "Three Of A Kind",
                    "points" => 10
                ],
                2 => [
                    "name" => "One Pair",
                      "points" => 2
                ],
                3 => [
                    "name" => "One Pair",
                    "points" => 2
                ],
                4 => [
                    "name" => "One Pair",
                      "points" => 2
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
                    "name" => "Full House",
                    "points" => 25
                ],
                3 => [
                    "name" => "One Pair",
                    "points" => 2
                ],
                4  => [
                    "name" => "Flush",
                    "points" => 20
                ]
            ],
            "total" => $total
        ];
        $res = $this->results($grid);
        $this->assertEquals($exp, $res);
    }

    public function testResults3(): void
    {
        $grid = $this->createMock(Grid::class);

        $rows = [
            ["8D","12H","8S","3D","12D"],
            ["6D","14H","6S","6H","14C"],
            ["7D","9H","7S","7H","9C"],
            ["11D","4D","4S","4H","3S"],
            ["5D","2H","5S","5H","5C"]
        ];
        $grid->method('getRows')->willReturn($rows);

        $total = 5 + 25 + 25 + 10 + 50 + 20 + 75 + 15;
        $exp = [
            "rows" => [
                0 => [
                    "name" => "Two Pairs",
                    "points" => 5
                ],
                1 => [
                    "name" => "Full House",
                    "points" => 25
                ],
                2 => [
                    "name" => "Full House",
                    "points" => 25
                ],
                3 => [
                    "name" => "Three Of A Kind",
                    "points" => 10
                ],
                4 => [
                    "name" => "Four Of A Kind",
                    "points" => 50
                ]
              ],
            "cols" => [
                0 => [
                    "name" => "Flush",
                    "points" => 20
                ],
                1 => [
                    "name" => "None",
                    "points" => 0
                ],
                2 => [
                    "name" => "Straight Flush",
                    "points" => 75
                ],
                3 => [
                    "name" => "Straight",
                    "points" => 15
                ],
                4 => [
                    "name" => "None",
                    "points" => 0
                ]
            ],
            "total" => $total
        ];
        $res = $this->results($grid);
        $this->assertEquals($exp, $res);
    }

    public function testResults4(): void
    {
        $grid = $this->createMock(Grid::class);

        $rows = [
            ["10C","14S","11C","12H","13C"],
            ["7H","9C","5H","14H","7S"],
            ["8H","6C","8D","3D","3H"],
            ["10S","14D","13D","12D","12S"],
            ["4S","2C","2S","2D","4C"]
        ];
        $grid->method('getRows')->willReturn($rows);

        $total = 15 + 2 + 5 + 2 + 25 + 2 + 2 + 0 + 2 + 0;
        $exp = [
            "rows" => [
                0 => [
                    "name" => "Straight",
                    "points" => 15
                ],
                1 => [
                    "name" => "One Pair",
                    "points" => 2
                ],
                2 => [
                    "name" => "Two Pairs",
                    "points" => 5
                ],
                3 => [
                    "name" => "One Pair",
                    "points" => 2
                ],
                4 => [
                    "name" => "Full House",
                    "points" => 25
                ]
              ],
            "cols" => [
                0 => [
                    "name" => "One Pair",
                    "points" => 2
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
                    "name" => "One Pair",
                    "points" => 2
                ],
                4 => [
                    "name" => "None",
                    "points" => 0
                ]
            ],
            "total" => $total
        ];
        $res = $this->results($grid);
        $this->assertEquals($exp, $res);
    }

    public function testResults5(): void
    {
        $grid = $this->createMock(Grid::class);

        $rows = [
            ["6S","8C","7D","6H","6D"],
            ["13S","12C","11D","10H","9S"],
            ["5S","5C","4D","4H","5D"],
            ["3S","3C","10D","2H","9H"],
            ["8S","7C","11S","13H","9D"]
        ];
        $grid->method('getRows')->willReturn($rows);

        $total = 10 + 15 + 25 + 2 + 0 + 20 + 20 + 2 + 20 + 10;
        $exp = [
            "rows" => [
                0 => [
                    "name" => "Three Of A Kind",
                    "points" => 10
                ],
                1 => [
                    "name" => "Straight",
                    "points" => 15
                ],
                2 => [
                    "name" => "Full House",
                    "points" => 25
                ],
                3 => [
                    "name" => "One Pair",
                    "points" => 2
                ],
                4 => [
                    "name" => "None",
                    "points" => 0
                ]
              ],
            "cols" => [
                0 => [
                    "name" => "Flush",
                    "points" => 20
                ],
                1 => [
                    "name" => "Flush",
                    "points" => 20
                ],
                2 => [
                    "name" => "One Pair",
                    "points" => 2
                ],
                3 => [
                    "name" => "Flush",
                    "points" => 20
                ],
                4 => [
                    "name" => "Three Of A Kind",
                    "points" => 10
                ]
            ],
            "total" => $total
        ];
        $res = $this->results($grid);
        $this->assertEquals($exp, $res);
    }
}
