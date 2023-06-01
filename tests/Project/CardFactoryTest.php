<?php

namespace App\Project;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class CardFactory.
 */
class CardFactoryTest extends TestCase
{
    public function testFullSet(): void
    {
        $suits = ['S', 'D', 'H', 'C'];
        $minValue = 2;
        $maxValue = 14;
        $cards = [];
        foreach($suits as $suit) {
            for ($value = $minValue; $value <= $maxValue; $value++) {
                $card = new Card($value, $suit);
                array_push($cards, $card);
            }
        }
        $cardFactory = new CardFactory();
        $this->assertInstanceOf("\App\Project\CardFactory", $cardFactory);

        $res = $cardFactory->fullSet();
        $this->assertEquals($cards, $res);
    }
}
