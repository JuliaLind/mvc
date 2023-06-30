<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;

class CardDataTraitTest extends TestCase
{
    use CardDataTrait;

    protected function setUp(): void
    {
        $this->cards = [new CardGraphic("S", "4"), new CardGraphic("D", "A")];
    }

    /**
     * Tests the getValues method
     */
    public function testGetValues(): void
    {

        $res = $this->getValues();
        $exp = [4, 14];
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the getAsString method
     */
    public function testGetAsString(): void
    {
        $res = $this->getAsString();
        $exp = ['4 Spades', 'Ace Diamonds' ];
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the getCardCount method
     */
    public function testGetCardCount(): void
    {
        $res = $this->getcardCount();
        $exp = 2;
        $this->assertEquals($exp, $res);
    }
}
