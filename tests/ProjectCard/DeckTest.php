<?php

namespace App\ProjectCard;

use PHPUnit\Framework\TestCase;

// use App\ProjectCard\NoCardsException;

/**
 * Test cases for Deck class.
 */
class DeckTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties
     */
    public function testCreateObject(): void
    {
        $deck = new Deck();
        $this->assertInstanceOf("\App\ProjectCard\Deck", $deck);

        $suits = ['S', 'D', 'H', 'C'];
        $minValue = 2;
        $maxValue = 14;
        $cards = [];
        foreach($suits as $suit) {
            for ($value = $minValue; $value <= $maxValue; $value++) {
                $card = strval($value).$suit;
                array_push($cards, $card);
            }
        }
        $res = $deck->getCards();
        $this->assertEquals($cards, $res);

        $res = count($res);
        $exp = 52;
        $this->assertEquals($exp, $res);
    }

    public function testDealOk(): void
    {
        $card = "12D";
        $card2 = "7C";
        $card3 = "8H";
        $factory = $this->createMock(CardFactory::class);
        $factory->method('fullSet')
        ->willReturn([$card, $card2, $card3]);
        $deck = new Deck($factory);
        $res = $deck->deal();
        $exp = $card3;
        $this->assertSame($exp, $res);
        $res = $deck->getCards();
        $exp = [$card, $card2];
        $this->assertSame($exp, $res);
    }


    /**
     * Construct deck and checks that NoCardsLeftException is
     * thrown when try to draw more cards then there
     * are in deck
     */
    public function testDealNotOk(): void
    {
        $factory = $this->createMock(CardFactory::class);
        $factory->method('fullSet')
        ->willReturn([]);
        $deck = new Deck($factory);
        $this->expectException(NoCardsException::class);
        $deck->deal();
    }

    /**
     * Construct deck, and checks that shuffle method
     * only changes the order of cards
     */
    public function testShuffleOk(): void
    {
        $cards = [];
        for ($i = 2; $i < 7; $i++) {
            array_push($cards, strval($i)."D");
        }
        $factory = $this->createMock(CardFactory::class);
        $factory->method('fullSet')
        ->willReturn($cards);

        $deck = new Deck($factory);
        $deck->shuffle();
        $exp = $cards;
        $res = $deck->getCards();
        // $this->assertNotEquals($exp, $res);
        $this->assertEqualsCanonicalizing($exp, $res);
    }

    public function testPossibleCards(): void
    {
        $cards = [];
        $exp = [];
        for ($i = 2; $i < 8; $i++) {
            $card = strval($i)."D";
            array_push($cards, $card);
            if ($i > 4 && $i % 2 === 1) {
                array_push($exp, $card);
            }
        }
        $factory = $this->createMock(CardFactory::class);
        $factory->method('fullSet')
        ->willReturn($cards);

        $deck = new Deck($factory);
        $res = $deck->possibleCards();
        $this->assertEquals($exp, $res);
        $this->assertEquals(2, count($res));
    }
}
