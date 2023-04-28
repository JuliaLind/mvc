<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;
use App\Exceptions\NoCardsLeftException;

/**
 * Test cases for class DeckOfCards.
 */
class DeckOfCardsTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties
     */
    public function testCreateObject(): void
    {
        $deck = new DeckOfCards();
        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);

        $res = $deck->getCardCount();
        $exp = 52;
        $this->assertEquals($exp, $res);

        $res = $deck->getValues();
        $exp = [];
        $loops = 4;
        while (--$loops >= 0) {
            for ($i = 2; $i <= 14; $i++) {
                $exp[] = $i;
            }
        }
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct deck and checks that the drawn card is the last card in deck
     */
    public function testDrawOk(): void
    {
        $deck = new DeckOfCards();
        $res = $deck->draw();
        $exp = new CardGraphic('S', 'A');
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct deck and checks that NoCardsLeftException is
     * thrown when try to draw more cards then there
     * are in deck
     */
    public function testDrawNotOk(): void
    {
        $deck = new DeckOfCards();
        $loops = 53;
        $this->expectException(NoCardsLeftException::class);
        while (--$loops >= 0) {
            $deck->draw();
        }

        $exp = 0;
        $res = $deck->getCardCount();
        $this->assertEquals($exp, $res);

    }

    /**
     * Construct deck, draw 7 cards and check that
     * remaining number of cards is 45
     */
    public function testCardCountOk(): void
    {
        $deck = new DeckOfCards();
        $loops = 7;
        while (--$loops >= 0) {
            $deck->draw();
        }
        $exp = 45;
        $res = $deck->getCardCount();
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct deck, and checks that getAsString() method
     * returns array with expected string values
     */
    public function testGetAsStringOk(): void
    {
        $deck = new DeckOfCards();
        $exp = [];
        foreach ([' Diamonds', ' Hearts', ' Clubs', ' Spades'] as $suit) {
            for ($i = 2; $i <= 10; $i++) {
                $exp[] = strval($i) . $suit;
            }
            foreach (['Jack', 'Queen', 'King', 'Ace'] as $rank) {
                $exp[] = $rank . $suit;
            }
        }
        $res = $deck->getAsString();
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct deck, empties it and checks that
     * getAsString() method returns empty array
     */
    public function testGetAsStringNotOk(): void
    {
        $deck = new DeckOfCards();
        $loops = 52;
        while (--$loops >= 0) {
            $deck->draw();
        }
        $exp = [];
        $res = $deck->getAsString();
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct deck, and checks that getImgLinks() method
     * returns array with expected string values
     */
    public function testGetImgLinksOk(): void
    {
        $deck = new DeckOfCards();
        $exp = [];
        foreach (['D', 'H', 'C', 'S'] as $suit) {
            for ($i = 2; $i <= 10; $i++) {
                $exp[] = "img/cards/" . strval($i) . $suit . ".svg";
            }
            foreach (['J', 'Q', 'K', 'A'] as $rank) {
                $exp[] = "img/cards/" . $rank . $suit . ".svg";
            }
        }
        $res = $deck->getImgLinks();
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct deck, empties it and checks that
     * getImgLinks() method returns empty array
     */
    public function testGetImgLinksNotOk(): void
    {
        $deck = new DeckOfCards();
        $loops = 52;
        while (--$loops >= 0) {
            $deck->draw();
        }
        $exp = [];
        $res = $deck->getImgLinks();
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct deck, and checks that shuffle method
     * only changes the order of cards
     */
    public function testShuffleOk(): void
    {
        $deck = new DeckOfCards();
        $exp = [];
        foreach ([' Diamonds', ' Hearts', ' Clubs', ' Spades'] as $suit) {
            for ($i = 2; $i <= 10; $i++) {
                $exp[] = strval($i) . $suit;
            }
            foreach (['Jack', 'Queen', 'King', 'Ace'] as $rank) {
                $exp[] = $rank . $suit;
            }
        }
        $deck->shuffle();

        $res = $deck->getAsString();
        $this->assertNotEquals($exp, $res);
        $this->assertEqualsCanonicalizing($exp, $res);
    }
}
