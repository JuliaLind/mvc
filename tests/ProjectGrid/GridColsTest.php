<?php

namespace App\ProjectGrid;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Hand.
 */
class GridColsTest extends TestCase
{
    /**
     * @var array<array<string>> $rows
     */
    protected array $rows;
    /**
     * @var array<array<string>> $cols
     */
    protected array $cols;

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
        $col0 = [
            0 => $card1,
            4 => $card8
        ];
        $col1 = [
            0 => $card2,
            1 => $card5
        ];
        $col2 = [
            0 => $card3
        ];
        $col3 = [
            1 => $card6,
            2 => $card7
        ];
        $col4 = [
            0 => $card4,
        ];
        $this->cols = [
            0 => $col0,
            1 => $col1,
            2 => $col2,
            3 => $col3,
            4 => $col4
        ];
    }

    public function testAll(): void
    {
        $gridCols = new GridCols();
        $res = $gridCols->all($this->rows);
        $exp = $this->cols;

        $this->assertEquals($exp, $res);
    }
}
