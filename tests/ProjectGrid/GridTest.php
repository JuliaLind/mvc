<?php

namespace App\ProjectGrid;

use PHPUnit\Framework\TestCase;
use App\ProjectCard\Card;

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
        $card = new Card(14, 'S');
        $bool = $this->grid->addCard(2, 4, $card);
        $res = $this->grid->getCards();
        $exp = $this->rows;
        $exp[2][4] = $card;
        $this->assertEquals($exp, $res);
        $this->assertTrue($bool);

        $res = $res[2][4];
        $this->assertEquals($res, $card);
    }

    public function testAddNotOk(): void
    {
        $card = new Card(10, 'D');
        $bool = $this->grid->addCard(0, 1, $card);
        $this->assertFalse($bool);
        $exp = $this->rows;
        $res = $this->grid->getCards();

        $this->assertEquals($exp, $res);
    }
}