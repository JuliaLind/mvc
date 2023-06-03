<?php

namespace App\ProjectGrid;

use PHPUnit\Framework\TestCase;
use App\ProjectCard\Card;

class EmptyCellFinderTest extends TestCase
{
    /**
     * @var array<array<Card>> $rows
     */
    protected array $rows;

    protected function setUp(): void
    {
        $card1 = new Card(2, "H");
        $card2 = new Card(14, "S");
        $card3 = new Card(2, "S");
        $card4 = new Card(4, "C");
        $card5 = new Card(5, "D");
        $card6 = new Card(13, "C");
        $card7 = new Card(13, "D");
        $card8 = new Card(13, "H");
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
        $res = $finder->single($row, 1, true);
        $this->assertEquals($exp, $res);
    }

    public function testAll(): void
    {
        $finder = new EmptyCellFinder();
        $rows = $this->rows;
        $res = $finder->all($rows);

        // // $row0 = [3];
        // // $row1 = [0, 2, 4];
        // // $row2 = [0, 1, 2, 4];
        // // $row3 = [0, 1, 2, 3, 4];
        // // $row4 = [1, 2, 3, 4];

        $exp = [
            // ['row' => 0, 'col' => 3],
            // ['row' => 1, 'col' => 0], ['row' => 1, 'col' => 2], ['row' => 1, 'col' => 4],
            // ['row' => 2, 'col' => 0], ['row' => 2, 'col' => 1], ['row' => 2, 'col' => 2], ['row' => 2, 'col' => 4],
            // ['row' => 3, 'col' => 0], ['row' => 3, 'col' => 1], ['row' => 3, 'col' => 2], ['row' => 3, 'col' => 3], ['row' => 3, 'col' => 4],
            // ['row' => 4, 'col' => 1], ['row' => 4, 'col' => 2], ['row' => 4, 'col' => 3], ['row' => 4, 'col' => 4]
            [0, 3],
            [1, 0], [1, 2], [1, 4],
            [2, 0], [2, 1], [2, 2], [2, 4],
            [3, 0], [3, 1], [3, 2], [3, 3], [3, 4],
            [4, 1], [4, 2], [4, 3], [4, 4]
        ];

        $this->assertEquals($exp, $res);
    }
}
