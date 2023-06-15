<?php

namespace App\ProjectGrid;

use PHPUnit\Framework\TestCase;
// use App\ProjectGrid\SlotNotEmptyException;

class GridTest extends TestCase
{
    /**
     * @var array<array<string>> $rows
     */
    protected array $rows;
    /**
     * @var array<array<string>> $cols
     */
    protected array $cols;
    protected Grid $grid;

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

        $grid = new Grid();
        $grid->setCards($rows);
        $this->grid = $grid;
    }

    public function testSetCards(): void
    {
        $grid = new Grid();
        $cards = $this->rows;
        $grid->setCards($cards);
        $res = $grid->getCards();

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

    public function testAddOk(): void
    {
        $this->assertEquals(0, $this->grid->getCardCount());
        $card = "14S";
        $this->grid->addCard(2, 4, $card);
        $res = $this->grid->getCards();
        $exp = $this->rows;
        $exp[2][4] = $card;
        $this->assertEquals($exp, $res);


        $res = $res[2][4];
        $this->assertEquals($res, $card);
        $this->assertEquals(1, $this->grid->getCardCount());
    }

    public function testAddNotOk(): void
    {
        $card = "10D";
        $this->expectException(SlotNotEmptyException::class);
        $this->grid->addCard(0, 1, $card);

        $exp = $this->rows;
        $res = $this->grid->getCards();

        $this->assertEquals($exp, $res);
    }

    public function testRowsAndCols2(): void
    {
        $cards = [
            ["14D", "14C", "14S", "5C", "10H"],
            ["10D", "8C", "8D", "5D", "6H"],
            ["12D", "3C", "2C", "5S", "7H"],
            ["13D", "4C", "9C", "5H", "8H"],
            ["11D", "7C", "10H", "8S", "9H"]
        ];

        $grid = new Grid();
        $grid->setCards($cards);
        $res = $grid->rowsAndCols();
        $exp = [ 'rows' => [
                ["14D", "14C", "14S", "5C", "10H"],
                ["10D", "8C", "8D", "5D", "6H"],
                ["12D", "3C", "2C", "5S", "7H"],
                ["13D", "4C", "9C", "5H", "8H"],
                ["11D", "7C", "10H", "8S", "9H"]
            ],
            'cols' => [
                [
                    "14D", "10D", "12D", "13D", "11D"
                ],
                [
                    "14C", "8C", "3C", "4C", "7C"
                ],
                [
                    "14S", "8D", "2C", "9C", "10H"
                ],
                [
                    "5C", "5D", "5S", "5H", "8S"
                ],
                [
                    "10H", "6H", "7H", "8H", "9H"
                ],
            ]
        ];
        $this->assertEquals($exp, $res);
    }
}
