<?php

namespace App\ProjectGrid;

use PHPUnit\Framework\TestCase;

class EmptyCellFinderTest extends TestCase
{
    /**
     * @var array<array<string>> $rows
     */
    protected array $rows;

    protected function setUp(): void
    {
        $card1 = "2H";
        $card2 = "14S";
        $card3 = "2S";
        $card4 = "4C";
        $card5 = "5D";
        $card6 = "13C";
        $card7 = "13D";
        $card8 = "13H";
        $row0 = [
            0 => $card1,
            1 => $card2,
            2 => $card3,
            4 => $card4
        ];
        $row1 = [
            1 => $card5,
            3 => $card6
        ];
        $row2 = [
            3 => $card7
        ];
        $row4 = [
            0 => $card8
        ];

        $rows = [
            0 => $row0,
            1 => $row1,
            2 => $row2,
            4 => $row4
        ];
        $this->rows = $rows;
    }

    public function testSingle(): void
    {
        $finder = new EmptyCellFinder();
        $row = $this->rows[1];
        $exp = [[1, 0], [1, 2], [1, 4]];
        // $res = $finder->single($row, 1, true);
        $res = $finder->single($row, 1);
        $this->assertEquals($exp, $res);
    }

    public function testAll(): void
    {
        $finder = new EmptyCellFinder();
        $rows = $this->rows;
        $res = $finder->all($rows);

        $exp = [
            [0, 3],
            [1, 0], [1, 2], [1, 4],
            [2, 0], [2, 1], [2, 2], [2, 4],
            [3, 0], [3, 1], [3, 2], [3, 3], [3, 4],
            [4, 1], [4, 2], [4, 3], [4, 4]
        ];

        $this->assertEquals($exp, $res);
    }
}
