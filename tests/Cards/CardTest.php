<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Card.
 */
class CardTest extends TestCase
{
    /**
     * Construct one of the "ordinary" cards and verify that the object has the expected
     * properties
     */
    public function testCreateObject(): void
    {
        $card = new Card("S", "J");
        $this->assertInstanceOf("\App\Cards\Card", $card);

        $res = $card->getIntValue();
        $exp = 11;
        $this->assertEquals($exp, $res);

        $res = $card->getSuit();
        $exp = "S";
        $this->assertEquals($exp, $res);

        $res = $card->getColor();
        $exp = "black";
        $this->assertEquals($exp, $res);

        $res = $card->getAsString();
        $exp = "Jack Spades";
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct a joker card and verify that the object has the expected
     * properties
     */
    public function testCreateDifferentObject(): void
    {
        $card = new Card("B", "joker");
        $this->assertInstanceOf("\App\Cards\Card", $card);

        $res = $card->getIntValue();
        $exp = 15;
        $this->assertEquals($exp, $res);

        $res = $card->getSuit();
        $exp = "B";
        $this->assertEquals($exp, $res);

        $res = $card->getColor();
        $exp = "black";
        $this->assertEquals($exp, $res);

        $res = $card->getAsString();
        $exp = "Joker Black";
        $this->assertEquals($exp, $res);
    }
}
