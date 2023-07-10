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

class SuggestionTraitPt2Test extends TestCase
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
            0 => [0 => "7D",                         3 => "7S", 4 => "10C"],
            2 => [                       2 =>"11H",  3 => "3H"            ],
            3 => [0 => "8D",                         3 => "7C"            ],
            4 => [0 => "6D", 1 => "13S", 2 => "13H", 3 => "6H", 4 => "6C" ]
        ];
        $grid->method('getRows')->willReturn($rows);
        $card = "6S";
        $deck = ["12D","10D","9D","5D","11C","3D","11S","5H","5S","14S","5C","2D"];
        $exp = [
            'col-rule' => "Flush",
            'row-rule' => "Straight",
            'slot' => [3, 1],
            'row-rules' => [
                ['rule-with-card' => "",'weight' => 0,'rule-without-card' => "Two Pairs"],
                ['rule-with-card' => "",'weight' => -49.5,'rule-without-card' => "Four Of A Kind"],
                ['rule-with-card' => "",'weight' => -25.5,'rule-without-card' => "Full House"],
                ['rule-with-card' => "Straight",'weight' => 17,'rule-without-card' => "Straight"],
                ['rule-with-card' => "",'weight' => -200,'rule-without-card' => ""],
            ],
            'col-rules' => [
                ['rule-with-card' => "One Pair",'weight' => -72.5,'rule-without-card' => "Straight Flush"],
                ['rule-with-card' => "Flush",'weight' => 21,'rule-without-card' => "Four Of A Kind"],
                ['rule-with-card' => "",'weight' => -15.5,'rule-without-card' => "Straight"],
                ['rule-with-card' => "Two Pairs",'weight' => 8,'rule-without-card' => "Two Pairs"],
                ['rule-with-card' => "Two Pairs",'weight' => -3.5,'rule-without-card' => "Three Of A Kind"],
            ],
            'tot-weight-slot' => 38.0
        ];
        $res = $this->suggestion($grid, $card, $deck);
        $this->assertEquals($exp, $res);
    }
}
