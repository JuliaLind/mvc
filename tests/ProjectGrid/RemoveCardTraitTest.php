<?php

namespace App\ProjectGrid;

use PHPUnit\Framework\TestCase;

class RemoveCardTraitTest extends TestCase
{
    use RemoveCardTrait;

    public function testRemoveCard(): void
    {
        $this->grid = [
            1 => [1 => "7C"],
            3 => [2 => "12C", 3 => "6C"],
            4 => [2 => "5C"]
        ];
        $this->cardCount = 4;
        $this->removeCard(1, 1);
        $exp = [
            3 => [2 => "12C", 3 => "6C"],
            4 => [2 => "5C"]
        ];
        $this->assertEquals($exp, $this->grid);
        $this->assertEquals(3, $this->cardCount);
        $this->removeCard(3, 2);
        $this->removeCard(3, 3);
        $this->expectException(SlotEmptyException::class);
        $this->removeCard(3, 3);
        $exp = [
            4 => [2 => "5C"]
        ];

        $this->expectException(SlotEmptyException::class);
        $this->removeCard(4, 3);
        $this->assertEquals($exp, $this->grid);
        $this->assertEquals(1, $this->cardCount);
        $this->removeCard(4, 2);
        $this->assertEquals([], $this->grid);
        $this->assertEquals(0, $this->cardCount);
    }

}
