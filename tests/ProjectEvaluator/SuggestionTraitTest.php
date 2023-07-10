<?php

namespace App\ProjectEvaluator;

use App\ProjectGrid\Grid;
use App\ProjectRules\RoyalFlush;
use App\ProjectRules\StraightFlush;
use App\ProjectRules\SameOfAKind;
use App\ProjectRules\FullHouse;
use App\ProjectRules\Flush;
use App\ProjectRules\Straight;
use App\ProjectRules\TwoPairs;
use PHPUnit\Framework\TestCase;

class SuggestionTraitTest extends TestCase
{
    use SuggestionTrait;
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

    public function testSuggestion(): void
    {
        $grid = $this->createMock(Grid::class);
        $rows = [
            0 => [0 => "11C"],
        ];
        $grid->method('getRows')->willReturn($rows);
        $card = "6H";
        $deck = [
            "2S", "12H", "2C", "4C", "5S", "10D", "14D", "6C",
            "10S", "9S", "4D", "13C", "11H", "13D", "6D",
            "14H", "3H", "4H", "5D", "13S", "14S", "9C", "8H"
        ];
        $exp = [
            'row-rule' => "Full House",
            'col-rule' => "Full House",
            'slot' => [0, 4],
            'row-rules' => [
                ['rule-with-card' => "Full House",'weight' => 26,'rule-without-card' => "Full House"],
                ['rule-with-card' => "Full House",'weight' => 25.5,'rule-without-card' => "Full House"],
                ['rule-with-card' => "Full House",'weight' => 25.5,'rule-without-card' => "Full House"],
                ['rule-with-card' => "Full House",'weight' => 25.5,'rule-without-card' => "Full House"],
                ['rule-with-card' => "Full House",'weight' => 25.5,'rule-without-card' => "Full House"],
            ],
            'col-rules' => [
                ['rule-with-card' => "Full House",'weight' => 26,'rule-without-card' => "Full House"],
                ['rule-with-card' => "Full House",'weight' => 25.5,'rule-without-card' => "Full House"],
                ['rule-with-card' => "Full House",'weight' => 25.5,'rule-without-card' => "Full House"],
                ['rule-with-card' => "Full House",'weight' => 25.5,'rule-without-card' => "Full House"],
                ['rule-with-card' => "Full House",'weight' => 25.5,'rule-without-card' => "Full House"],
            ],
            'tot-weight-slot' => 26 + 25.5
        ];
        $res = $this->suggestion($grid, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion2(): void
    {
        $grid = $this->createMock(Grid::class);
        $card = "10S";
        $deck = [
            "2S", "12H", "2C", "4C",
            "5S", "10D", "14D", "6C"
        ];
        $rows = [
            0 => [0 => "11C",             2 => "11H", 3 => "6D",  4 => "6H"],
            1 => [0 => "13S", 1 => "14S", 2 => "13C", 3 => "13D", 4 => "14H"],
            3 => [0 => "9S",              2 => "4D",  3 => "3H",  4 => "4H"],
            4 => [0 => "9C",  1 => "5D",                         4 => "8H"]
        ];
        $grid->method('getRows')->willReturn($rows);
        $exp = [
            'row-rule' => "One Pair",
            'col-rule' => "Two Pairs",
            'slot' => [2, 1],
            'row-rules' => [
                ['rule-with-card' => "",'weight' => -25.5,'rule-without-card' => "Full House"],
                ['rule-with-card' => "",'weight' => -200,'rule-without-card' => ""],
                ['rule-with-card' => "One Pair",'weight' => 2.5,'rule-without-card' => "One Pair"],
                ['rule-with-card' => "",'weight' => -10.5,'rule-without-card' => "Three Of A Kind"],
                ['rule-with-card' => "One Pair",'weight' => 2,'rule-without-card' => "One Pair"],
            ],
            'col-rules' => [
                ['rule-with-card' => "",'weight' => 0,'rule-without-card' => "One Pair"],
                ['rule-with-card' => "Two Pairs",'weight' => 6,'rule-without-card' => "Two Pairs"],
                ['rule-with-card' => "One Pair",'weight' => 2,'rule-without-card' => "One Pair"],
                ['rule-with-card' => "One Pair",'weight' => 2,'rule-without-card' => "One Pair"],
                ['rule-with-card' => "",'weight' => -20.5, 'rule-without-card' => "Flush"],
            ],
            'tot-weight-slot' => 2.5 + 6
        ];
        $res = $this->suggestion($grid, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion3(): void
    {
        $grid = $this->createMock(Grid::class);
        $card = "11S";
        $deck = [];
        $rows = [
            ["11C", "6C", "11H", "6D", "6H"],
            ["13S", "14S", "13C", "13D", "14H"],
            [0 => "2S", 1 => "12H", 3 => "2C", 4 => "4C",],
            ["9S", "5S", "4D",  "3H",  "4H"],
            ["9C", "5D", "10D", "14D", "8H"]
        ];
        $grid->method('getRows')->willReturn($rows);
        $exp = [
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
        $res = $this->suggestion($grid, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion4(): void
    {
        $grid = $this->createMock(Grid::class);
        $card = "6C";
        $deck = [
            "2S",
            "12H",
            "2C",
            "4C",
            "5S",
            "10D",
            "14D"
        ];
        $rows = [
            0 => [0 => "11C",             2 => "11H", 3 => "6D",  4 => "6H"],
            1 => [0 => "13S", 1 => "14S", 2 => "13C", 3 => "13D", 4 => "14H"],
            3 => [0 => "9S",              2 => "4D",  3 => "3H",  4 => "4H"],
            4 => [0 => "9C",  1 => "5D",              3=>"10S",   4 => "8H"]
        ];
        $grid->method('getRows')->willReturn($rows);

        $exp = [
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
                    'weight' => -10.5,
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
                    'weight' => -17.5,
                    'rule-without-card' => "Flush"
                ],
            ],
            'tot-weight-slot' => 29.0
        ];

        $res = $this->suggestion($grid, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion5(): void
    {
        $grid = $this->createMock(Grid::class);
        $card = "6C";
        $deck = [
            "2S",
            "12H",
            "2C",
            "4C",
            "5S",
            "10D",
            "14D"
        ];
        $rows = [
            0 => [0 => "11C", 1 => "13S", 3 => "9S", 4 => "9C"],
            1 => [            1 => "14S",            4 => "5D"],
            2 => [0 => "11H", 1 => "13C", 3 => "4D"           ],
            3 => [0 => "6D",  1 => "13D", 3 => "3H", 4 => "10S"],
            4 => [0 => "6H",  1 => "14H", 3 => "4H", 4 => "8H"]
        ];
        $grid->method('getRows')->willReturn($rows);

        $exp = [
            'row-rule' => "",
            'col-rule' => "Full House",
            'slot' => [1, 0],
            'row-rules' => [
                ['rule-with-card' => "",'weight' => 0,'rule-without-card' => "One Pair"],
                ['rule-with-card' => "",'weight' => 0,'rule-without-card' => "Two Pairs"],
                ['rule-with-card' => "",'weight' => 0,'rule-without-card' => "One Pair"],
                ['rule-with-card' => "One Pair",'weight' => 3,'rule-without-card' => "One Pair"],
                ['rule-with-card' => "One Pair",'weight' => -17.5,'rule-without-card' => "Flush"],
            ],
            'col-rules' => [
                ['rule-with-card' => "Full House",'weight' => 29,'rule-without-card' => "Two Pairs"],
                ['rule-with-card' => "",'weight' => -200,'rule-without-card' => ""],
                ['rule-with-card' => "",'weight' => 0.5,'rule-without-card' => "One Pair"],
                ['rule-with-card' => "",'weight' => -10.5,'rule-without-card' => "Three Of A Kind"],
                ['rule-with-card' => "",'weight' => 0,'rule-without-card' => "One Pair"],
            ],

            'tot-weight-slot' => 29.0
        ];

        $res = $this->suggestion($grid, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testSuggestion6(): void
    {
        $grid = $this->createMock(Grid::class);
        $card = "7C";
        $deck = ["2H","2S","3H","3S","3D","4H","4C","5D","5S","5C","7H","8D","8H","9C","10S","10H","11H","11C","12H","12S","13H","13D","14D","14S"];
        $rows = [];
        $grid->method('getRows')->willReturn($rows);

        $exp = [
            'row-rule' => "Full House",
            'col-rule' => "Full House",
            'slot' => [0, 0],
            'row-rules' => [
                [
                    'rule-with-card' => "Full House",
                    'weight' => 25,
                    'rule-without-card' => "Full House"
                ],
                [
                    'rule-with-card' => "Full House",
                    'weight' => 25,
                    'rule-without-card' => "Full House"
                ],
                [
                    'rule-with-card' => "Full House",
                    'weight' => 25,
                    'rule-without-card' => "Full House"
                ],
                [
                    'rule-with-card' => "Full House",
                    'weight' => 25,
                    'rule-without-card' => "Full House"
                ],
                [
                    'rule-with-card' => "Full House",
                    'weight' => 25,
                    'rule-without-card' => "Full House"
                ],

            ],
            'col-rules' => [
                [
                    'rule-with-card' => "Full House",
                    'weight' => 25,
                    'rule-without-card' => "Full House"
                ],
                [
                    'rule-with-card' => "Full House",
                    'weight' => 25,
                    'rule-without-card' => "Full House"
                ],
                [
                    'rule-with-card' => "Full House",
                    'weight' => 25,
                    'rule-without-card' => "Full House"
                ],
                [
                    'rule-with-card' => "Full House",
                    'weight' => 25,
                    'rule-without-card' => "Full House"
                ],
                [
                    'rule-with-card' => "Full House",
                    'weight' => 25,
                    'rule-without-card' => "Full House"
                ],
            ],
        ];

        $res = $this->suggestion($grid, $card, $deck);
        $this->assertEquals($exp, $res);
    }
}
