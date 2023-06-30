<?php

namespace App\ProjectGrid;

use PHPUnit\Framework\TestCase;

// use App\ProjectGrid\SlotNotEmptyException;

class GridTest extends TestCase
{
    // /**
    //  * @var array<array<string>> $rows
    //  */
    // protected array $rows;

    // protected Grid $grid;

    // protected function setUp(): void
    // {
    //     $card1 = "2H";
    //     $card2 = "14S";
    //     $card3 = "2S";
    //     $card4 = "4C";
    //     $card5 = "5D";
    //     $card6 = "13C";
    //     $card7 = "13D";
    //     $card8 = "13H";
    //     $row0 = [
    //         0 => $card1,
    //         1 => $card2,
    //         2 => $card3,
    //         4 => $card4
    //     ];
    //     $row1 = [
    //         1 => $card5,
    //         3 => $card6
    //     ];
    //     $row2 = [
    //         3 => $card7
    //     ];
    //     $row4 = [
    //         0 => $card8
    //     ];

    //     $rows = [
    //         0 => $row0,
    //         1 => $row1,
    //         2 => $row2,
    //         4 => $row4
    //     ];
    //     $this->rows = $rows;

    //     $grid = new Grid();
    //     $grid->setCards($rows);
    //     $this->grid = $grid;
    // }

    // public function testSetCards(): void
    // {
    //     $grid = new Grid();
    //     $cards = $this->rows;
    //     $grid->setCards($cards);
    //     $res = $grid->getCards();

    //     $this->assertEquals($cards, $res);
    // }

    // public function testAddOk(): void
    // {
    //     $this->assertEquals(0, $this->grid->getCardCount());
    //     $card = "14S";
    //     $this->grid->addCard(2, 4, $card);
    //     $res = $this->grid->getCards();
    //     $exp = $this->rows;
    //     $exp[2][4] = $card;
    //     $this->assertEquals($exp, $res);


    //     $res = $res[2][4];
    //     $this->assertEquals($res, $card);
    //     $this->assertEquals(1, $this->grid->getCardCount());
    // }

    // public function testAddNotOk(): void
    // {
    //     $card = "10D";
    //     $this->expectException(SlotNotEmptyException::class);
    //     $this->grid->addCard(0, 1, $card);

    //     $exp = $this->rows;
    //     $res = $this->grid->getCards();

    //     $this->assertEquals($exp, $res);
    // }
}
