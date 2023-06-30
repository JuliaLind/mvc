<?php

namespace App\ProjectGrid;

use PHPUnit\Framework\TestCase;

class CardCountTraitTest extends TestCase
{
    use CardCountTrait;

    public function testCardCount(): void
    {
        $this->cardCount = 8;
        $exp = 8;
        $res = $this->getCardCount();
        $this->assertSame($exp, $res);
    }

}
