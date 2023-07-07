<?php

namespace App\ProjectRules;

use App\ProjectGrid\Grid;
use PHPUnit\Framework\TestCase;

class EmptyCellTraitTest extends TestCase
{
    use EmptyCellTrait;

    public function testOneEmptyNotOk(): void
    {
        $grid = $this->createMock(Grid::class);
        $grid->method('getCardCount')->willReturn(25);
        $this->expectException(NoEmptySlotsException::class);

        $this->oneEmpty($grid);
    }

    public function testOneEmptyOk(): void
    {
        $grid = $this->createMock(Grid::class);
        $rows = [
            0 => [
                0 => "card",
                1 => "card",
                2 => "card",
            ],
            3 => [
                4 => "card"
            ]
        ];
        $grid->method('getRows')->willReturn($rows);
        $exp = [0, 3];
        $res = $this->oneEmpty($grid);
        $this->assertEquals($exp, $res);
    }

    public function testOneEmptyOk2(): void
    {
        $grid = $this->createMock(Grid::class);
        $rows = [
            0 => [
                0 => "card",
                1 => "card",
                2 => "card",
                3 => "card",
                4 => "card",
            ],
            3 => [
                4 => "card"
            ]
        ];
        $grid->method('getRows')->willReturn($rows);
        $exp = [1, 0];
        $res = $this->oneEmpty($grid);
        $this->assertEquals($exp, $res);
    }

    public function testOneEmptyOk3(): void
    {
        $grid = $this->createMock(Grid::class);
        $rows = [
            0 => [
                0 => "card",
                1 => "card",
                2 => "card",
                3 => "card",
                4 => "card",
            ],
            1 => [
                0 => "card",
                1 => "card",
                2 => "card",
                3 => "card",
                4 => "card",
            ],
            2 => [
                0 => "card",
                1 => "card",
                2 => "card",
                3 => "card",
                4 => "card",
            ],
            3 => [
                0 => "card",
                1 => "card",
                2 => "card",
                3 => "card",
                4 => "card",
            ],
            4 => [
                0 => "card",
                2 => "card",
                3 => "card",
                4 => "card",
            ],
        ];
        $grid->method('getRows')->willReturn($rows);
        $exp = [4, 1];
        $res = $this->oneEmpty($grid);
        $this->assertEquals($exp, $res);
    }
}
