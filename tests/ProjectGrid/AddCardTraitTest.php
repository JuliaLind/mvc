<?php

namespace App\ProjectGrid;

use PHPUnit\Framework\TestCase;

class AddCardTraitTest extends TestCase
{
    use AddCardTrait;


    public function testAddCard(): void
    {
        $this->addCard(3, 2, "12C");
        $this->addCard(4, 2, "5C");
        $this->addCard(3, 3, "6C");
        $this->addCard(1, 1, "7C");
        $this->expectException(SlotNotEmptyException::class);
        $this->addCard(3, 3, "9C");
        $exp = [
            1 => [1 => "7C"],
            3 => [2 => "12C", 3 => "6C"],
            4 => [2 => "5C"]
        ];
        $this->assertEquals($exp, $this->grid);
    }

}
