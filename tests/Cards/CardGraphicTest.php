<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class CardGraphic.
 */
class CardGraphicTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties
     */
    public function testCreateObject(): void
    {
        $card = new CardGraphic("S", "J");
        $this->assertInstanceOf("\App\Cards\CardGraphic", $card);

        $res = $card->getImgLink();
        $exp = "img/cards/JS.svg";
        $this->assertEquals($exp, $res);
    }
}
