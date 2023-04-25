<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */
class DeckOfCardsExtTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties
     */
    public function testCreateObject(): void
    {
        $deck = new DeckOfCardsExt();
        $this->assertInstanceOf("\App\Cards\DeckOfCardsExt", $deck);

        $res = $deck->getCardCount();
        $exp = 54;
        $this->assertEquals($exp, $res);

        $res = $deck->getValues();
        $exp = [];
        $loops = 4;
        while (--$loops >= 0) {
            for ($i = 2; $i <= 14; $i++) {
                $exp[] = $i;
            }
        }
        $exp = array_merge($exp, [15, 15]);
        $this->assertEquals($exp, $res);

        $res = $deck->draw();
        $exp = new CardGraphic('R', 'joker');
        $this->assertEquals($exp, $res);

        $res = $deck->draw();
        $exp = new CardGraphic('B', 'joker');
        $this->assertEquals($exp, $res);
    }
}
