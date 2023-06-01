<?php

namespace App\Project;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Card.
 */
class CardTest extends TestCase
{
    public function testCreateObject(): void
    {
        $card = new Card(14, "S");
        $this->assertInstanceOf("\App\Project\Card", $card);

        $res = $card->getValue();
        $exp = 14;
        $this->assertEquals($exp, $res);

        $res = $card->getSuit();
        $exp = "S";
        $this->assertEquals($exp, $res);
    }
}
