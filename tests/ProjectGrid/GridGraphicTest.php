<?php

namespace App\ProjectGrid;

use PHPUnit\Framework\TestCase;

class GridGraphicTest extends TestCase
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

    public function testGraphic(): void
    {
        $empty = ['img' => "", 'alt' => ""];
        $row0 = [
            0 => [
                'img' => "img/project-cards/2H.svg",
                'alt' => "2H"
            ],
            1 => [
                'img' => "img/project-cards/14S.svg",
                'alt' => "14S"
            ],
            2 => [
                'img' => "img/project-cards/2S.svg",
                'alt' => "2S"
            ],
            3 => $empty,
            4 => [
                'img' => "img/project-cards/4C.svg",
                'alt' => "4C"
            ],
        ];
        $row1 = [
            0 => $empty,
            1 => [
                'img' => "img/project-cards/5D.svg",
                'alt' => "5D"
            ],
            2 => $empty,
            3 => [
                'img' => "img/project-cards/13C.svg",
                'alt' => "13C"
            ],
            4 => $empty
        ];
        $row2 = [
            0 => $empty,
            1 => $empty,
            2 => $empty,
            3 => [
                'img' => "img/project-cards/13D.svg",
                'alt' => "13D"
            ],
            4 => $empty
        ];
        $row4 = [
            0 => [
                'img' => "img/project-cards/13H.svg",
                'alt' => "13H"
            ],
            1 => $empty,
            2 => $empty,
            3 => $empty,
            4 => $empty,
        ];
        $row3 = [
            0 => $empty,
            1 => $empty,
            2 => $empty,
            3 => $empty,
            4 => $empty
        ];
        $exp = [
            0 => $row0,
            1 => $row1,
            2 => $row2,
            3 => $row3,
            4 => $row4
        ];

        $grid = new GridGraphic();
        $res = $grid->graphic($this->rows);
        $this->assertEquals($exp, $res);
    }
}
