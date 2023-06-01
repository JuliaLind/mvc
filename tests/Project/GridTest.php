<?php

namespace App\Project;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Hand.
 */
class GridTest extends TestCase
{
    /**
     * @var array<array<Card>> $rows
     */
    protected array $rows;
    /**
     * @var array<array<Card>> $cols
     */
    protected array $cols;
    protected Grid $grid;

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

        $grid = new Grid();
        $grid->setCards($rows);
        $this->grid = $grid;
    }

    public function testSetCards(): void
    {
        $grid = new Grid();
        $cards = $this->rows;
        $res = $grid->setCards($cards);

        $this->assertEquals($cards, $res);
    }

    public function testRowsAndCols(): void
    {
        $exp = [
            'rows' => $this->rows,
            'cols' => $this->cols
        ];
        $res = $this->grid->rowsAndCols();

        $this->assertEquals($exp, $res);
    }

    public function testGraphic(): void
    {
        $empty = ['filled' => false, 'img' => "", 'alt' => ""];
        $row0 = [
            0 => [
                'filled' => true,
                'img' => "img/project-cards/2H.svg",
                'alt' => "2H"
            ],
            1 => [
                'filled' => true,
                'img' => "img/project-cards/14S.svg",
                'alt' => "14S"
            ],
            2 => [
                'filled' => true,
                'img' => "img/project-cards/2S.svg",
                'alt' => "2S"
            ],
            3 => $empty,
            4 => [
                'filled' => true,
                'img' => "img/project-cards/4C.svg",
                'alt' => "4C"
            ],
        ];
        $row1 = [
            0 => $empty,
            1 => [
                'filled' => true,
                'img' => "img/project-cards/5D.svg",
                'alt' => "5D"
            ],
            2 => $empty,
            3 => [
                'filled' => true,
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
                'filled' => true,
                'img' => "img/project-cards/13D.svg",
                'alt' => "13D"
            ],
            4 => $empty
        ];
        $row4 = [
            0 => [
                'filled' => true,
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

        $res = $this->grid->graphic();
        $this->assertEquals($exp, $res);
    }

    public function testAddOk(): void
    {
        $emptySlot = ['filled' => false, 'img' => "", 'alt' => ""];
        $emptyRow = [$emptySlot, $emptySlot, $emptySlot, $emptySlot, $emptySlot];
        $card = new Card(14, 'S');
        $grid = new Grid();
        $bool = $grid->addCard(2, 4, $card);
        $res = $grid->graphic();
        $exp = [
            0 => $emptyRow,
            1 => $emptyRow,
            2 => [
                0 => $emptySlot,
                1 => $emptySlot,
                2 => $emptySlot,
                3 => $emptySlot,
                4 => [
                    'filled' => true,
                    'img' => "img/project-cards/14S.svg",
                    'alt' => "14S"
                ]
            ],
            3 => $emptyRow,
            4 => $emptyRow
        ];
        $this->assertEquals($exp, $res);
        $this->assertTrue($bool);
    }

    public function testAddNotOk(): void
    {
        $emptySlot = ['filled' => false, 'img' => "", 'alt' => ""];
        $emptyRow = [$emptySlot, $emptySlot, $emptySlot, $emptySlot, $emptySlot];
        $card = new Card(10, 'D');
        $grid = new Grid();
        $initialGrid = [
            2 => [
                4 => new Card(14, 'S'),
            ]
        ];
        $grid->setCards($initialGrid);
        $bool = $grid->addCard(2, 4, $card);
        $this->assertFalse($bool);
        $res = $grid->graphic();
        $exp = [
            0 => $emptyRow,
            1 => $emptyRow,
            2 => [
                0 => $emptySlot,
                1 => $emptySlot,
                2 => $emptySlot,
                3 => $emptySlot,
                4 => [
                    'filled' => true,
                    'img' => "img/project-cards/14S.svg",
                    'alt' => "14S"
                ]
            ],
            3 => $emptyRow,
            4 => $emptyRow
        ];
        $this->assertEquals($exp, $res);
    }
}
