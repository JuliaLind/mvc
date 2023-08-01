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

class HouseSuggestionTraitTest extends TestCase
{
    use HouseSuggestionTrait;
    use HouseColSuggestionTrait;
    use HouseRowSuggestionTrait;
    use RowsToColsTrait;

    public function testhouseSuggestion(): void
    {
        $grid = $this->createMock(Grid::class);
        $rows = [
            0 => [0 => "7D",                         3 => "7S", 4 => "10C"],
            2 => [                       2 =>"11H",  3 => "3H"            ],
            3 => [0 => "8D",                         3 => "7C"            ],
            4 => [0 => "6D", 1 => "13S", 2 => "13H", 3 => "6H", 4 => "6C" ]
        ];
        $grid->method('getRows')->willReturn($rows);
        $card = "6S";
        $deck = ["12D","10D","9D","5D","11C","3D","11S","5H","5S","14S","5C","2D"];
        $exp = [1, 3];
        $res = $this->houseSuggestion($grid, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testhouseSuggestion2(): void
    {
        $grid = $this->createMock(Grid::class);

        $rows = [
            [0 => "2C", 1 => "4D", 2 => "2S"                        ],
            [           1 => "6D", 2 => "13S", 3 => "12D"           ],
            [           1 => "7D", 2 => "11S",            4 => "10D"],
            [0 => "3C", 1 => "3D"                                   ],
            [           1 => "5D"                                   ]
        ];

        $grid->method('getRows')->willReturn($rows);
        $card = "4S";
        $deck = ["3H","5C","6C","6H","7C","7S","9C","10S","10C","11D","11H","12S"];
        $exp = [4, 0];
        $res = $this->houseSuggestion($grid, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testhouseSuggestion3(): void
    {
        $grid = $this->createMock(Grid::class);

        $rows = [
            [0 => "6S",              2 => "7D"                      ],
            [0 => "13S", 1 => "12C", 2 => "11D"                     ],
            [0 => "5S",              2 => "4D", 3 => "2H"           ],
            [0 => "3S",              2 => "10D", 3 => "4H"          ],
            [                                    3 => "13H"          ]
        ];

        $grid->method('getRows')->willReturn($rows);
        $card = "6D";
        $deck = ["3C","5D","5C","6H","7C","8C","8S","9D","9H","9S","10H","11S"];
        $exp = [4, 4];
        $res = $this->houseSuggestion($grid, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testhouseSuggestion4(): void
    {
        $grid = $this->createMock(Grid::class);

        $rows = [
            [0 => "6S",              2 => "7D",            4 => "6D"],
            [0 => "13S", 1 => "12C", 2 => "11D"                     ],
            [0 => "5S",              2 => "4D", 3 => "2H"           ],
            [0 => "3S",              2 => "10D", 3 => "4H"          ],
            [                                    3 => "13H"          ]
        ];

        $grid->method('getRows')->willReturn($rows);
        $card = "5C";
        $deck = ["3C","5D", "6H","7C","8C","8S","9D","9H","9S","10H","11S"];
        $exp = [4, 0];
        $res = $this->houseSuggestion($grid, $card, $deck);
        $this->assertEquals($exp, $res);
    }
}
