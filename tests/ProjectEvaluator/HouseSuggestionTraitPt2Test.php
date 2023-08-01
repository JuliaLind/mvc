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

class HouseSuggestionTraitPt2Test extends TestCase
{
    use HouseLogicTrait;
    use HouseLogicTrait2;
    use HouseSuggestionTrait;
    use HouseColSuggestionTrait;
    use HouseRowSuggestionTrait;
    use RowsToColsTrait;

    public function testhouseSuggestion(): void
    {
        $grid = $this->createMock(Grid::class);
        $rows = [
            0 => [0 => "12H"],
            1 => [1 => "10S"],
            2 => [2 => "11D"],
        ];
        $grid->method('getRows')->willReturn($rows);
        $card = "8D";
        $deck = ["2H","3H","3C","5C","6C","6S","7H","7C","8S","8C","8H","9D","9H","10H","11C","11S","11H","12C","13S","13H","14D"];
        $exp = [2, 3];
        $res = $this->houseSuggestion($grid, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testhouseSuggestion2(): void
    {
        $grid = $this->createMock(Grid::class);
        $rows = [
            0 => [0 => "12H"],
            1 => [1 => "10S"],
            2 => [2 => "11D", 3 => "8D"],
        ];
        $grid->method('getRows')->willReturn($rows);
        $card = "13H";
        $deck = ["2H","3H","3C","5C","6C","6S","7H","7C","8S","8C","8H","9D","9H","10H","11C","11S","11H","12C","13S","14D"];
        $exp = [0, 4];
        $res = $this->houseSuggestion($grid, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testhouseSuggestion3(): void
    {
        $grid = $this->createMock(Grid::class);
        $rows = [
            0 => [0 => "12H", 4 => "13H"],
            1 => [1 => "10S"],
            2 => [2 => "11D", 3 => "8D"],
        ];
        $grid->method('getRows')->willReturn($rows);
        $card = "3C";
        $deck = ["2H","3H","5C","6C","6S","7H","7C","8S","8C","8H","9D","9H","10H","11C","11S","11H","12C","13S","14D"];
        $exp = [3, 0];
        $res = $this->houseSuggestion($grid, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testhouseSuggestion4(): void
    {
        $grid = $this->createMock(Grid::class);
        $rows = [
            0 => [0 => "12H", 4 => "13H"],
            1 => [1 => "10S"],
            2 => [2 => "11D", 3 => "8D"],
            3 => [0 => "3C"]
        ];
        $grid->method('getRows')->willReturn($rows);
        $card = "13S";
        $deck = ["2H","3H","5C","6C","6S","7H","7C","8S","8C","8H","9D","9H","10H","11C","11S","11H","12C","13S","14D"];
        $exp = [1, 4];
        $res = $this->houseSuggestion($grid, $card, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testhouseSuggestion5(): void
    {
        $grid = $this->createMock(Grid::class);
        $rows = [
            0 => [0 => "12H", 4 => "13H"],
            1 => [1 => "10S"],
            2 => [2 => "11D", 3 => "8D"],
            3 => [0 => "3C", 2 => "5C"]
        ];
        $grid->method('getRows')->willReturn($rows);
        $card = "11H";
        $deck = ["2H","3H","6C","6S","7H","7C","8S","8C","8H","9D","9H","10H","11C","11S","12C","13S","14D"];
        $exp = [0, 2];
        $res = $this->houseSuggestion($grid, $card, $deck);
        $this->assertEquals($exp, $res);
    }
}
